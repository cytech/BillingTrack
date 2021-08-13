<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Quotes\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use BT\Support\FileNames;
use BT\Support\HTML;
use BT\Support\NumberFormatter;
use BT\Support\Statuses\QuoteStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Quote extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['quoteItems', 'custom', 'amount', 'activities', 'attachments', 'mailQueue', 'notes'];

    protected $guarded = ['id'];

    protected $dates = ['expires_at', 'quote_date','deleted_at'];

    protected $appends = ['formatted_quote_date', 'formatted_expires_at','status_text', 'formatted_summary'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function activities()
    {
        return $this->morphMany('BT\Modules\Activity\Models\Activity', 'audit');
    }

    public function amount()
    {
        return $this->hasOne('BT\Modules\Quotes\Models\QuoteAmount');
    }

    public function attachments()
    {
        return $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');
    }

    public function client()
    {
        return $this->belongsTo('BT\Modules\Clients\Models\Client');
    }

    public function clientAttachments()
    {
        $relationship = $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');

        $relationship->where('client_visibility', 1);

        return $relationship;
    }

    public function companyProfile()
    {
        return $this->belongsTo('BT\Modules\CompanyProfiles\Models\CompanyProfile');
    }

    public function currency()
    {
        return $this->belongsTo('BT\Modules\Currencies\Models\Currency', 'currency_code', 'code');
    }

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\QuoteCustom');
    }

    public function group()
    {
        return $this->hasOne('BT\Modules\Groups\Models\Group');
    }

    public function invoice()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\Invoice');
    }

    public function invoicetrashed()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\Invoice', 'invoice_id', 'id')->onlyTrashed();
    }

    public function workorder()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\Workorder');
    }

    public function mailQueue()
    {
        return $this->morphMany('BT\Modules\MailQueue\Models\MailQueue', 'mailable');
    }

    public function items()
    {
        return $this->hasMany('BT\Modules\Quotes\Models\QuoteItem')
            ->orderBy('display_order');
    }

    public function notes()
    {
        return $this->morphMany('BT\Modules\Notes\Models\Note', 'notable');
    }

    // This and items() are the exact same. This is added to appease the IDE gods
    // and the fact that Laravel has a protected items property.
    public function quoteItems()
    {
        return $this->hasMany('BT\Modules\Quotes\Models\QuoteItem')
            ->orderBy('display_order');
    }

    public function user()
    {
        return $this->belongsTo('BT\Modules\Users\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAttachmentPathAttribute()
    {
        return attachment_path('quotes/' . $this->id);
    }

    public function getAttachmentPermissionOptionsAttribute()
    {
        return ['0' => trans('bt.not_visible'), '1' => trans('bt.visible')];
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatted_quote_date;
    }

    public function getFormattedQuoteDateAttribute()
    {
        return DateFormatter::format($this->attributes['quote_date']);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return DateFormatter::format($this->attributes['updated_at']);
    }

    public function getFormattedExpiresAtAttribute()
    {
        return DateFormatter::format($this->attributes['expires_at']);
    }

    public function getFormattedTermsAttribute()
    {
        return nl2br($this->attributes['terms']);
    }

    public function getFormattedFooterAttribute()
    {
        return nl2br($this->attributes['footer']);
    }

    public function getStatusTextAttribute()
    {
        $statuses = QuoteStatuses::statuses();

        return $statuses[$this->attributes['quote_status_id']];
    }

    public function getPdfFilenameAttribute()
    {
        return FileNames::quote($this);
    }

    public function getPublicUrlAttribute()
    {
        return route('clientCenter.public.quote.show', [$this->url_key]);
    }

    public function getIsForeignCurrencyAttribute()
    {
        if ($this->attributes['currency_code'] == config('bt.baseCurrency'))
        {
            return false;
        }

        return true;
    }

    public function getHtmlAttribute()
    {
        return HTML::quote($this);
    }

    public function getFormattedNumericDiscountAttribute()
    {
        return NumberFormatter::format($this->attributes['discount']);
    }

    public function  getFormattedSummaryAttribute(){
        return mb_strimwidth($this->attributes['summary'],0,50,'...');
    }

    /**
     * Gathers a summary of both invoice and item taxes to be displayed on invoice.
     *
     * @return array
     */
    public function getSummarizedTaxesAttribute()
    {
        $taxes = [];

        foreach ($this->items as $item)
        {
            if ($item->taxRate)
            {
                $key = $item->taxRate->name;

                if (!isset($taxes[$key]))
                {
                    $taxes[$key]              = new \stdClass();
                    $taxes[$key]->name        = $item->taxRate->name;
                    $taxes[$key]->percent     = $item->taxRate->formatted_percent;
                    $taxes[$key]->total       = $item->amount->tax_1;
                    $taxes[$key]->raw_percent = $item->taxRate->percent;
                }
                else
                {
                    $taxes[$key]->total += $item->amount->tax_1;
                }
            }

            if ($item->taxRate2)
            {
                $key = $item->taxRate2->name;

                if (!isset($taxes[$key]))
                {
                    $taxes[$key]              = new \stdClass();
                    $taxes[$key]->name        = $item->taxRate2->name;
                    $taxes[$key]->percent     = $item->taxRate2->formatted_percent;
                    $taxes[$key]->total       = $item->amount->tax_2;
                    $taxes[$key]->raw_percent = $item->taxRate2->percent;
                }
                else
                {
                    $taxes[$key]->total += $item->amount->tax_2;
                }
            }
        }

        foreach ($taxes as $key => $tax)
        {
            $taxes[$key]->total = CurrencyFormatter::format($tax->total, $this->currency);
        }

        return $taxes;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // not invoiced is where workorder->invoice_id = 0,
    // or where invoice()->invoice_status_id = 1 or 4 ('draft' or 'canceled')
    // or invoice is trashed
    public function scopeNotinvoiced($query)
    {
        $query->where('invoice_id', 0)
            ->orWhereHas('invoice', function ($query) {
                $query->whereIn('invoice_status_id', [1, 4]);
            })
            ->orWhereHas('invoicetrashed');
    }

    public function scopeClientId($query, $clientId = null)
    {
        if ($clientId)
        {
            $query->where('client_id', $clientId);
        }

        return $query;
    }

    public function scopeCompanyProfileId($query, $companyProfileId)
    {
        if ($companyProfileId)
        {
            $query->where('company_profile_id', $companyProfileId);
        }

        return $query;
    }

    public function scopeDraft($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('draft'));
    }

    public function scopeSent($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('sent'));
    }

    public function scopeApproved($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('approved'));
    }

    public function scopeSentOrApproved($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('sent'))
                     ->orWhere('quote_status_id', '=', QuoteStatuses::getStatusId('approved'));
    }

    public function scopeRejected($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('rejected'));
    }

    public function scopeCanceled($query)
    {
        return $query->where('quote_status_id', '=', QuoteStatuses::getStatusId('canceled'));
    }

    public function scopeStatus($query, $status = null)
    {
        switch ($status)
        {
            case 'draft':
                $query->draft();
                break;
            case 'sent':
                $query->sent();
                break;
            case 'viewed':
                $query->viewed();
                break;
            case 'approved':
                $query->approved();
                break;
            case 'rejected':
                $query->rejected();
                break;
            case 'canceled':
                $query->canceled();
                break;
        }

        return $query;
    }

    public function scopeYearToDate($query)
    {
        return $query->where('quote_date', '>=', date('Y') . '-01-01')
            ->where('quote_date', '<=', date('Y') . '-12-31');
    }

    public function scopeThisQuarter($query)
    {
        return $query->where('quote_date', '>=', Carbon::now()->firstOfQuarter())
            ->where('quote_date', '<=', Carbon::now()->lastOfQuarter());
    }

    public function scopeDateRange($query, $fromDate, $toDate)
    {
        return $query->where('quote_date', '>=', $fromDate)
            ->where('quote_date', '<=', $toDate);
    }

    public function scopeKeywords($query, $keywords)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where(DB::raw('lower(number)'), 'like', '%' . $keywords . '%')
                ->orWhere('quotes.quote_date', 'like', '%' . $keywords . '%')
                ->orWhere('expires_at', 'like', '%' . $keywords . '%')
                ->orWhere('summary', 'like', '%' . $keywords . '%')
                ->orWhereIn('client_id', function ($query) use ($keywords)
                {
                    $query->select('id')->from('clients')->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(unique_name))"), 'like', '%' . $keywords . '%');
                });
        }

        return $query;
    }
}
