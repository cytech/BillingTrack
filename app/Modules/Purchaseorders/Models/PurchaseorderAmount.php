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

use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseorderAmount extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['formatted_numeric_balance', 'formatted_total', 'formatted_balance'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function purchaseorder()
    {
        return $this->belongsTo('BT\Modules\Purchaseorders\Models\Purchaseorder');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->purchaseorder->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->purchaseorder->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->purchaseorder->currency);
    }

    public function getFormattedPaidAttribute()
    {
        return CurrencyFormatter::format($this->attributes['paid'], $this->purchaseorder->currency);
    }

    public function getFormattedBalanceAttribute()
    {
        return CurrencyFormatter::format($this->attributes['balance'], $this->purchaseorder->currency);
    }

    public function getFormattedNumericBalanceAttribute()
    {
        return NumberFormatter::format($this->attributes['balance']);
    }

    public function getFormattedDiscountAttribute()
    {
        return CurrencyFormatter::format($this->attributes['discount'], $this->purchaseorder->currency);
    }

    /**
     * Retrieve the formatted total prior to conversion.
     * @return string
     */
    public function getFormattedTotalWithoutConversionAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'] / $this->purchaseorder->exchange_rate);
    }
}
