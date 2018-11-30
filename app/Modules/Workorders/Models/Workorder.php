<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use FI\Events\WorkorderCreated;
use FI\Events\WorkorderCreating;
use FI\Events\WorkorderDeleted;
use FI\Support\CurrencyFormatter;
use FI\Support\DateFormatter;
use FI\Support\FileNames;
use FI\Support\HTML;
use FI\Support\NumberFormatter;
use FI\Support\Statuses\WorkorderStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workorder extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $softCascade = ['workorderItems', 'custom', 'amount', 'activities', 'attachments', 'mailQueue', 'notes'];

    protected $guarded = ['id'];

    protected $appends = ['formatted_workorder_date', 'formatted_expires_at', 'formatted_job_date', 'status_text', 'formatted_summary'];

    protected $dates = ['expires_at', 'workorder_date','job_date','deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($workorder)
        {
            event(new WorkorderCreating($workorder));
        });

        static::created(function ($workorder)
        {
            event(new WorkorderCreated($workorder));
        });

        static::deleted(function($workorder)
        {
            event( new WorkorderDeleted( $workorder ) );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function activities()
    {
        return $this->morphMany('FI\Modules\Activity\Models\Activity', 'audit');
    }

    public function amount()
    {
        return $this->hasOne('FI\Modules\Workorders\Models\WorkorderAmount');
    }

    public function attachments()
    {
        return $this->morphMany('FI\Modules\Attachments\Models\Attachment', 'attachable');
    }

    public function client()
    {
        return $this->belongsTo('FI\Modules\Clients\Models\Client');
    }

    public function clientAttachments()
    {
        $relationship = $this->morphMany('FI\Modules\Attachments\Models\Attachment', 'attachable');

        $relationship->where('client_visibility', 1);

        return $relationship;
    }

    public function companyProfile()
    {
        return $this->belongsTo('FI\Modules\CompanyProfiles\Models\CompanyProfile');
    }

    public function currency()
    {
        return $this->belongsTo('FI\Modules\Currencies\Models\Currency', 'currency_code', 'code');
    }

    public function custom()
    {
        return $this->hasOne('FI\Modules\CustomFields\Models\WorkorderCustom');
    }

    public function group()
    {
        return $this->hasOne('FI\Modules\Groups\Models\Group');
    }

    public function invoice()
    {
        return $this->belongsTo('FI\Modules\Invoices\Models\Invoice');
    }

    public function quote()
    {
        return $this->hasOne('FI\Modules\Quotes\Models\Quote');
    }

    public function mailQueue()
    {
        return $this->morphMany('FI\Modules\MailQueue\Models\MailQueue', 'mailable');
    }

    public function items()
    {
        return $this->hasMany('FI\Modules\Workorders\Models\WorkorderItem')
            ->orderBy('display_order');
    }

    public function notes()
    {
        return $this->morphMany('FI\Modules\Notes\Models\Note', 'notable');
    }

    // This and items() are the exact same. This is added to appease the IDE gods
    // and the fact that Laravel has a protected items property.
    public function workorderItems()
    {
        return $this->hasMany('FI\Modules\Workorders\Models\WorkorderItem')
            ->orderBy('display_order');
    }

    public function user()
    {
        return $this->belongsTo('FI\Modules\Users\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAttachmentPathAttribute()
    {
        return attachment_path('workorders/' . $this->id);
    }

    public function getAttachmentPermissionOptionsAttribute()
    {
        return ['0' => trans('fi.not_visible'), '1' => trans('fi.visible')];
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatted_workorder_date;
    }

    public function getFormattedWorkorderDateAttribute()
    {
        return DateFormatter::format($this->attributes['workorder_date']);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return DateFormatter::format($this->attributes['updated_at']);
    }

    public function getFormattedExpiresAtAttribute()
    {
        return DateFormatter::format($this->attributes['expires_at']);
    }

    public function getFormattedJobDateAttribute()
    {
        return DateFormatter::format($this->attributes['job_date']);

    }

    public function getFormattedStartTimeAttribute()
    {
        return DateFormatter::formattime($this->attributes['start_time']);

    }

    public function getFormattedEndTimeAttribute()
    {
        return DateFormatter::formattime($this->attributes['end_time']);

    }

    public function getFormattedJobLengthAttribute()
    {
        $datetime1 = new \DateTime($this->attributes['start_time']);
        $datetime2 = new \DateTime($this->attributes['end_time']);
        $interval = $datetime1->diff($datetime2);
        return $interval->h+$interval->i/60;//return decimal hours

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
        $statuses = WorkorderStatuses::statuses();

        return $statuses[$this->attributes['workorder_status_id']];
    }

    public function getPdfFilenameAttribute()
    {
        return FileNames::workorder($this);
    }

    public function getIsForeignCurrencyAttribute()
    {
        if ($this->attributes['currency_code'] == config('fi.baseCurrency'))
        {
            return false;
        }

        return true;
    }

    public function getHtmlAttribute()
    {
        return HTML::workorder($this);
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
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('draft'));
    }

    public function scopeSent($query)
    {
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('sent'));
    }

    public function scopeApproved($query)
    {
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('approved'));
    }

    public function scopeSentOrApproved($query)
    {
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('sent'))
                     ->orWhere('workorder_status_id', '=', WorkorderStatuses::getStatusId('approved'));
    }

    public function scopeRejected($query)
    {
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('rejected'));
    }

    public function scopeCanceled($query)
    {
        return $query->where('workorder_status_id', '=', WorkorderStatuses::getStatusId('canceled'));
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
        return $query->where('workorder_date', '>=', date('Y') . '-01-01')
            ->where('workorder_date', '<=', date('Y') . '-12-31');
    }

    public function scopeThisQuarter($query)
    {
        return $query->where('workorder_date', '>=', Carbon::now()->firstOfQuarter())
            ->where('workorder_date', '<=', Carbon::now()->lastOfQuarter());
    }

    public function scopeDateRange($query, $fromDate, $toDate)
    {
        return $query->where('job_date', '>=', $fromDate)
            ->where('job_date', '<=', $toDate);
    }

    public function scopeKeywords($query, $keywords)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where(DB::raw('lower(number)'), 'like', '%' . $keywords . '%')
                ->orWhere('workorders.workorder_date', 'like', '%' . $keywords . '%')
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