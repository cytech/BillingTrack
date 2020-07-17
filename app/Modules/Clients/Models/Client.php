<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Clients\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Support\CurrencyFormatter;
use BT\Support\Statuses\InvoiceStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Client extends Model
{

    use SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['contacts', 'custom', 'invoices', 'workorders', 'quotes',  'projects','recurringInvoices',
                            'merchant', 'attachments', 'notes'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['formatted_balance'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function firstOrCreateByUniqueName($uniqueName)
    {
        $client = self::firstOrNew([
            'unique_name' => $uniqueName,
        ]);

        if (!$client->id)
        {
            $client->name = $uniqueName;
            $client->save();
            return self::find($client->id);
        }

        return $client;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function attachments()
    {
        return $this->morphMany('BT\Modules\Attachments\Models\Attachment', 'attachable');
    }

    public function contacts()
    {
        return $this->hasMany('BT\Modules\Clients\Models\Contact');
    }

    public function currency()
    {
        return $this->belongsTo('BT\Modules\Currencies\Models\Currency', 'currency_code', 'code');
    }

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\ClientCustom');
    }

    public function expenses()
    {
        return $this->hasMany('BT\Modules\Expenses\Models\Expense');
    }

    public function invoices()
    {
        return $this->hasMany('BT\Modules\Invoices\Models\Invoice');
    }

    public function payments()
    {
        return $this->hasMany('BT\Modules\Payments\Models\Payment');
    }

    public function merchant()
    {
        return $this->hasOne('BT\Modules\Merchant\Models\MerchantClient');
    }

    public function notes()
    {
        return $this->morphMany('BT\Modules\Notes\Models\Note', 'notable');
    }

    /*public function payments()
    {
        return $this->hasManyThrough('BT\Modules\Payments\Models\Payment', 'BT\Modules\Invoices\Models\Invoice');
    }*/

    public function projects()
    {
        return $this->hasMany('BT\Modules\TimeTracking\Models\TimeTrackingProject');
    }

    public function quotes()
    {
        return $this->hasMany('BT\Modules\Quotes\Models\Quote');
    }

    public function workorders()
    {
        return $this->hasMany('BT\Modules\Workorders\Models\Workorder');
    }

    public function recurringInvoices()
    {
        return $this->hasMany('BT\Modules\RecurringInvoices\Models\RecurringInvoice');
    }

    public function user()
    {
        return $this->hasOne('BT\Modules\Users\Models\User');
    }

    public function size()
    {
        return $this->belongsTo('BT\Modules\Sizes\Models\Size');
    }

    public function industry()
    {
        return $this->belongsTo('BT\Modules\Industries\Models\Industry');
    }

    public function paymentterm()
    {
        return $this->belongsTo('BT\Modules\PaymentTerms\Models\PaymentTerm');
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAttachmentPathAttribute()
    {
        return attachment_path('clients/' . $this->id);
    }

    public function getAttachmentPermissionOptionsAttribute()
    {
        return ['0' => trans('bt.not_visible')];
    }

    public function getFormattedBalanceAttribute()
    {
        return CurrencyFormatter::format($this->balance, $this->currency);
    }

    public function getFormattedPaidAttribute()
    {
        return CurrencyFormatter::format($this->paid, $this->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->total, $this->currency);
    }

    public function getFormattedAddressAttribute()
    {
        return nl2br(formatAddress($this));
    }

    public function getFormattedAddress2Attribute()
    {
        return nl2br(formatAddress2($this));
    }

    public function getClientEmailAttribute()
    {
        return $this->email;
    }

    public function getClientTermsAttribute()
    {
        if ($this->paymentterm->id != 1) {
            return $this->paymentterm->num_days;
        } else
            return config('bt.invoicesDueAfter');
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeGetSelect()
    {
        return self::select('clients.*',
            DB::raw('(' . $this->getBalanceSql() . ') as balance'),
            DB::raw('(' . $this->getPaidSql() . ') AS paid'),
            DB::raw('(' . $this->getTotalSql() . ') AS total')
        );
    }

    public function scopeStatus($query, $status)
    {
        if ($status == 'active')
        {
            $query->where('active', 1);
        }
        elseif ($status == 'inactive')
        {
            $query->where('active', 0);
        }
        elseif ($status == 'company')
        {
            $query->where('is_company', 1);
        }
        elseif ($status == 'individual')
        {
            $query->where('is_company', 0);
        }

        return $query;
    }

    public function scopeKeywords($query, $keywords)
    {
        if ($keywords)
        {
            $keywords = explode(' ', $keywords);

            foreach ($keywords as $keyword)
            {
                if ($keyword)
                {
                    $keyword = strtolower($keyword);

                    $query->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(unique_name),LOWER(email),phone,fax,mobile)"), 'LIKE', "%$keyword%");
                }
            }
        }

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Subqueries
    |--------------------------------------------------------------------------
    */

    private function getBalanceSql()
    {
        return DB::table('invoice_amounts')->select(DB::raw('sum(balance)'))->whereIn('invoice_id', function ($q)
        {
            $q->select('id')
                ->from('invoices')
                ->where('invoices.client_id', '=', DB::raw(DB::getTablePrefix() . 'clients.id'))
                ->where('invoices.invoice_status_id', '<>', DB::raw(InvoiceStatuses::getStatusId('canceled')));
        })->toSql();
    }

    private function getPaidSql()
    {
        return DB::table('invoice_amounts')->select(DB::raw('sum(paid)'))->whereIn('invoice_id', function ($q)
        {
            $q->select('id')->from('invoices')->where('invoices.client_id', '=', DB::raw(DB::getTablePrefix() . 'clients.id'));
        })->toSql();
    }

    private function getTotalSql()
    {
        return DB::table('invoice_amounts')->select(DB::raw('sum(total)'))->whereIn('invoice_id', function ($q)
        {
            $q->select('id')->from('invoices')->where('invoices.client_id', '=', DB::raw(DB::getTablePrefix() . 'clients.id'));
        })->toSql();
    }
}
