<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use BT\Support\FileNames;
use BT\Support\HTML;
use BT\Support\NumberFormatter;
use BT\Support\Statuses\PurchaseorderStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Purchaseorder extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = [/*'payments',*/ 'purchaseorderItems', 'custom', 'amount', 'activities', 'attachments', 'mailQueue', 'notes'];

    protected $guarded = ['id'];

    protected $dates = ['due_at', 'purchaseorder_date', 'deleted_at'];

    protected $appends = ['formatted_purchaseorder_date', 'formatted_due_at', 'formatted_summary'];

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
        return $this->hasOne('BT\Modules\Purchaseorders\Models\PurchaseorderAmount');
    }

    public function attachments()
    {
        return $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');
    }

    public function vendor()
    {
        return $this->belongsTo('BT\Modules\Vendors\Models\Vendor');
    }

    public function vendorAttachments()
    {
        $relationship = $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');

        if ($this->status_text == 'paid')
        {
            $relationship->whereIn('vendor_visibility', [1, 2]);
        }
        else
        {
            $relationship->where('vendor_visibility', 1);
        }

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
        return $this->hasOne('BT\Modules\CustomFields\Models\PurchaseorderCustom');
    }

    public function group()
    {
        return $this->belongsTo('BT\Modules\Groups\Models\Group');
    }

    public function items()
    {
        return $this->hasMany('BT\Modules\Purchaseorders\Models\PurchaseorderItem')
            ->orderBy('display_order');
    }

    // This and items() are the exact same. This is added to appease the IDE gods
    // and the fact that Laravel has a protected items property.
    public function purchaseorderItems()
    {
        return $this->hasMany('BT\Modules\Purchaseorders\Models\PurchaseorderItem')
            ->orderBy('display_order');
    }

    public function mailQueue()
    {
        return $this->morphMany('BT\Modules\MailQueue\Models\MailQueue', 'mailable');
    }

    public function notes()
    {
        return $this->morphMany('BT\Modules\Notes\Models\Note', 'notable');
    }

//    public function payments()
//    {
//        return $this->hasMany('BT\Modules\Payments\Models\Payment');
//    }

//    public function quote()
//    {
//        return $this->hasOne('BT\Modules\Quotes\Models\Quote');
//    }
//
//    public function workorder()
//    {
//        return $this->hasOne('BT\Modules\Workorders\Models\Workorder');
//    }

    public function transactions()
    {
        return $this->hasMany('BT\Modules\Merchant\Models\PurchaseorderTransaction');
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
        return attachment_path('purchaseorders/' . $this->id);
    }

    public function getAttachmentPermissionOptionsAttribute()
    {
        return [
            '0' => trans('bt.not_visible'),
            '1' => trans('bt.visible'),
            '2' => trans('bt.visible_after_payment'),
        ];
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatted_purchaseorder_date;
    }

    public function getFormattedPurchaseorderDateAttribute()
    {
        return DateFormatter::format($this->attributes['purchaseorder_date']);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return DateFormatter::format($this->attributes['updated_at']);
    }

    public function getFormattedDueAtAttribute()
    {
        return DateFormatter::format($this->attributes['due_at']);
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
        $statuses = PurchaseorderStatuses::statuses();

        return $statuses[$this->attributes['purchaseorder_status_id']];
    }

    public function getIsOverdueAttribute()
    {
        // Only purchaseorders in Sent status qualify to be overdue
        if ($this->attributes['due_at'] < date('Y-m-d') and $this->attributes['purchaseorder_status_id'] == PurchaseorderStatuses::getStatusId('sent'))
            return 1;

        return 0;
    }

//    public function getPublicUrlAttribute()
//    {
//        return route('vendorCenter.public.purchaseorder.show', [$this->url_key]);
//    }

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
        return HTML::purchaseorder($this);
    }

    public function getPdfFilenameAttribute()
    {
        return FileNames::purchaseorder($this);
    }

    public function getFormattedNumericDiscountAttribute()
    {
        return NumberFormatter::format($this->attributes['discount']);
    }

    public function getIsPayableAttribute()
    {
        return $this->status_text <> 'canceled' and $this->amount->balance > 0;
    }

    public function  getFormattedSummaryAttribute(){
        return mb_strimwidth($this->attributes['summary'],0,50,'...');
    }

    /**
     * Gathers a summary of both purchaseorder and item taxes to be displayed on purchaseorder.
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

    public function scopeVendorId($query, $vendorId = null)
    {
        if ($vendorId)
        {
            $query->where('vendor_id', $vendorId);
        }

        return $query;
    }

    public function scopeDraft($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('draft'));
    }

    public function scopeSent($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('sent'));
    }

    public function scopeReceived($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('received'));
    }

    public function scopePartial($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('partial'));
    }

    public function scopeSentOrPartial($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('sent'))
            ->orWhere('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('partial'));
    }

    public function scopePaid($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('paid'));
    }

    public function scopeCanceled($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('canceled'));
    }

    public function scopeCompanyProfileId($query, $companyProfileId)
    {
        if ($companyProfileId)
        {
            $query->where('company_profile_id', $companyProfileId);
        }

        return $query;
    }

    public function scopeNotCanceled($query)
    {
        return $query->where('purchaseorder_status_id', '<>', PurchaseorderStatuses::getStatusId('canceled'));
    }

    public function scopeStatusIn($query, $statuses)
    {
        $statusCodes = [];

        foreach ($statuses as $status)
        {
            $statusCodes[] = PurchaseorderStatuses::getStatusId($status);
        }

        return $query->whereIn('purchaseorder_status_id', $statusCodes);
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
            case 'received':
                $query->received();
                break;
            case 'partial':
                $query->partial();
                break;
            case 'viewed':
                $query->viewed();
                break;
            case 'paid':
                $query->paid();
                break;
            case 'canceled':
                $query->canceled();
                break;
            case 'overdue':
                $query->overdue();
                break;
        }

        return $query;
    }

    public function scopeOverdue($query)
    {
        // Only purchaseorders in Sent status qualify to be overdue
        return $query
            ->where('purchaseorder_status_id', '=', PurchaseorderStatuses::getStatusId('sent'))
            ->where('due_at', '<', date('Y-m-d'));
    }

    public function scopeYearToDate($query)
    {
        return $query->where('purchaseorder_date', '>=', date('Y') . '-01-01')
            ->where('purchaseorder_date', '<=', date('Y') . '-12-31');
    }

    public function scopeThisQuarter($query)
    {
        return $query->where('purchaseorder_date', '>=', Carbon::now()->firstOfQuarter())
            ->where('purchaseorder_date', '<=', Carbon::now()->lastOfQuarter());
    }

    public function scopeDateRange($query, $fromDate, $toDate)
    {
        return $query->where('purchaseorder_date', '>=', $fromDate)
            ->where('purchaseorder_date', '<=', $toDate);
    }

    public function scopeKeywords($query, $keywords = null)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where(DB::raw('lower(number)'), 'like', '%' . $keywords . '%')
                ->orWhere('purchaseorders.purchaseorder_date', 'like', '%' . $keywords . '%')
                ->orWhere('due_at', 'like', '%' . $keywords . '%')
                ->orWhere('summary', 'like', '%' . $keywords . '%')
                ->orWhereIn('vendor_id', function ($query) use ($keywords)
                {
                    $query->select('id')->from('vendors')->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(name))"), 'like', '%' . $keywords . '%');
                });
        }

        return $query;
    }
}
