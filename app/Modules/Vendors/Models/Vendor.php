<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Vendors\Models;

use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Support\CurrencyFormatter;
use BT\Support\Statuses\PurchaseorderStatuses;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function firstOrCreateByName($name)
    {
        $vendor = self::firstOrNew([
            'name' => $name,
        ]);

        if (!$vendor->id)
        {
            $vendor->name = $name;
            $vendor->save();
            return self::find($vendor->id);
        }

        return $vendor;
    }

    public static function inUse($id)
    {
        if (Purchaseorder::where('vendor_id', $id)->count())
        {
            return true;
        }

        if (Expense::where('vendor_id', $id)->count())
        {
            return true;
        }

        return false;
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
        return $this->hasMany('BT\Modules\Vendors\Models\Contact');
    }

    public function currency()
    {
        return $this->belongsTo('BT\Modules\Currencies\Models\Currency', 'currency_code', 'code');
    }

    public function custom()
    {
        return $this->hasOne('BT\Modules\CustomFields\Models\VendorCustom');
    }

    public function notes()
    {
        return $this->morphMany('BT\Modules\Notes\Models\Note', 'notable');
    }

    public function user()
    {
        return $this->hasOne('BT\Modules\Users\Models\User');
    }

    public function paymentterm()
    {
        return $this->belongsTo('BT\Modules\PaymentTerms\Models\PaymentTerm');
    }

    public function purchaseorders()
    {
        return $this->hasMany('BT\Modules\Purchaseorders\Models\Purchaseorder');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAttachmentPathAttribute()
    {
        return attachment_path('vendors/' . $this->id);
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

    public function getVendorEmailAttribute()
    {
        return $this->email;
    }

    public function getVendorTermsAttribute()
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
        return self::select('vendors.*',
            DB::raw('(' . $this->getBalanceSql() . ') as balance'),
//            DB::raw('(' . $this->getPaidSql() . ') AS paid'),
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
        return DB::table('purchaseorder_amounts')->select(DB::raw('sum(balance)'))->whereIn('purchaseorder_id', function ($q)
        {
            $q->select('id')
                ->from('purchaseorders')
                ->where('purchaseorders.vendor_id', '=', DB::raw(DB::getTablePrefix() . 'purchaseorders.id'))
                ->where('purchaseorders.purchaseorder_status_id', '<>', DB::raw(PurchaseorderStatuses::getStatusId('canceled')));
        })->toSql();
    }
//
//    private function getPaidSql()
//    {
//        return DB::table('invoice_amounts')->select(DB::raw('sum(paid)'))->whereIn('invoice_id', function ($q)
//        {
//            $q->select('id')->from('invoices')->where('invoices.vendor_id', '=', DB::raw(DB::getTablePrefix() . 'vendors.id'));
//        })->toSql();
//    }
//
    private function getTotalSql()
    {
        return DB::table('purchaseorder_amounts')->select(DB::raw('sum(total)'))->whereIn('purchaseorder_id', function ($q)
        {
            $q->select('id')->from('purchaseorders')->where('purchaseorders.vendor_id', '=', DB::raw(DB::getTablePrefix() . 'vendors.id'));
        })->toSql();
    }


    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function getList()
    {
        return self::whereIn('id', function ($query)
        {
            $query->select('vendor_id')->distinct()->from('expenses');
        })->orderBy('name')
            ->pluck('name', 'id')
            ->all();
    }
}
