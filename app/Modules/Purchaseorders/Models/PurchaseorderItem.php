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
use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use BT\Support\Statuses\PurchaseorderItemStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseorderItem extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['amount'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'item_id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function amount()
    {
        return $this->hasOne('BT\Modules\Purchaseorders\Models\PurchaseorderItemAmount', 'item_id');
    }

    public function purchaseorder()
    {
        return $this->belongsTo('BT\Modules\Purchaseorders\Models\Purchaseorder');
    }

    public function taxRate()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate');
    }

    public function taxRate2()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id');
    }

    public function product()
    {
        return $this->belongsTo('BT\Modules\Products\Models\Product',
            'resource_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedQuantityAttribute()
    {
        return NumberFormatter::format($this->attributes['quantity']);
    }

    public function getFormattedNumericPriceAttribute()
    {
        return NumberFormatter::format($this->attributes['price']);
    }

    public function getFormattedPriceAttribute()
    {
        return CurrencyFormatter::format($this->attributes['price'], $this->purchaseorder->currency);
    }

    public function getFormattedNumericCostAttribute()
    {
        return NumberFormatter::format($this->attributes['cost']);
    }

    public function getFormattedCostAttribute()
    {
        return CurrencyFormatter::format($this->attributes['cost'], $this->purchaseorder->currency);
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->attributes['description']);
    }

    public function getStatusTextAttribute()
    {
        $statuses = PurchaseorderItemStatuses::statuses();

        return $statuses[$this->attributes['rec_status_id']];
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeOpen($query)
    {
        return $query->where('rec_status_id', '=', PurchaseorderItemStatuses::getStatusId('open'));
    }

    public function scopeReceived($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderItemStatuses::getStatusId('received'));
    }

    public function scopePartial($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderItemStatuses::getStatusId('partial'));
    }

    public function scopeCanceled($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderItemStatuses::getStatusId('canceled'));
    }

    public function scopeExtra($query)
    {
        return $query->where('purchaseorder_status_id', '=', PurchaseorderItemStatuses::getStatusId('extra'));
    }

    public function scopeStatus($query, $status = null)
    {
        switch ($status)
        {
            case 'open':
                $query->draft();
                break;
            case 'received':
                $query->sent();
                break;
            case 'partial':
                $query->received();
                break;
            case 'canceled':
                $query->viewed();
                break;
            case 'extra':
                $query->paid();
                break;
        }

        return $query;
    }

    public function scopeByDateRange($query, $from, $to)
    {
        return $query->whereIn('purchaseorder_id', function ($query) use ($from, $to)
        {
            $query->select('id')
                ->from('purchaseorders')
                ->where('purchaseorder_date', '>=', $from)
                ->where('purchaseorder_date', '<=', $to);
        });
    }
}
