<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\RecurringInvoices\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RecurringInvoice extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['recurringInvoiceItems', 'custom', 'amount', 'activities'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $appends = ['formatted_next_date', 'formatted_stop_date', 'formatted_summary'];

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
        return $this->hasOne('BT\Modules\RecurringInvoices\Models\RecurringInvoiceAmount');
    }

    public function client()
    {
        return $this->belongsTo('BT\Modules\Clients\Models\Client');
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
        return $this->hasOne('BT\Modules\CustomFields\Models\RecurringInvoiceCustom');
    }

    public function group()
    {
        return $this->belongsTo('BT\Modules\Groups\Models\Group');
    }

    public function items()
    {
        return $this->hasMany('BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem')
            ->orderBy('display_order');
    }

    // This and items() are the exact same. This is added to appease the IDE gods
    // and the fact that Laravel has a protected items property.
    public function recurringInvoiceItems()
    {
        return $this->hasMany('BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem')
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

    public function getFormattedFooterAttribute()
    {
        return nl2br($this->attributes['footer']);
    }

    public function getFormattedNextDateAttribute()
    {
        if ($this->attributes['next_date'] <> '0000-00-00')
        {
            return DateFormatter::format($this->attributes['next_date']);
        }

        return '';
    }

    public function getFormattedNumericDiscountAttribute()
    {
        return NumberFormatter::format($this->attributes['discount']);
    }

    public function getFormattedStopDateAttribute()
    {
        if ($this->attributes['stop_date'] <> '0000-00-00')
        {
            return DateFormatter::format($this->attributes['stop_date']);
        }

        return '';
    }

    public function getFormattedTermsAttribute()
    {
        return nl2br($this->attributes['terms']);
    }

    public function getIsForeignCurrencyAttribute()
    {
        if ($this->attributes['currency_code'] == config('bt.baseCurrency'))
        {
            return false;
        }

        return true;
    }

    public function  getFormattedSummaryAttribute(){
        return mb_strimwidth($this->attributes['summary'],0,50,'...');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('stop_date', '0000-00-00')
            ->orWhere('stop_date', '>', date('Y-m-d'));
    }

    public function scopeClientId($query, $clientId = null)
    {
        if ($clientId)
        {
            $query->where('client_id', $clientId);
        }

        return $query;
    }

    public function scopeCompanyProfileId($query, $companyProfileId = null)
    {
        if ($companyProfileId)
        {
            $query->where('company_profile_id', $companyProfileId);
        }

        return $query;
    }

    public function scopeInactive($query)
    {
        return $query->where('stop_date', '<>', '0000-00-00')
            ->where('stop_date', '<=', date('Y-m-d'));
    }

    public function scopeKeywords($query, $keywords = null)
    {
        if ($keywords)
        {
            $keywords = strtolower($keywords);

            $query->where('summary', 'like', '%' . $keywords . '%')
                ->orWhereIn('client_id', function ($query) use ($keywords)
                {
                    $query->select('id')->from('clients')->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(unique_name))"), 'like', '%' . $keywords . '%');
                });
        }

        return $query;
    }

    public function scopeRecurNow($query)
    {
        $query->where('next_date', '<>', '0000-00-00');
        $query->where('next_date', '<=', date('Y-m-d'));
        $query->where(function ($q)
        {
            $q->where('stop_date', '0000-00-00');
            $q->orWhere('next_date', '<=', DB::raw('stop_date'));
        });

        return $query;
    }

    public function scopeStatus($query, $status)
    {
        switch ($status)
        {
            case 'active':
                return $query->active();
            case 'inactive':
                return $query->inactive();
        }

        return $query;
    }
}
