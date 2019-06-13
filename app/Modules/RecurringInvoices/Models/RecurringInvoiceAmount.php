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

use BT\Support\CurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringInvoiceAmount extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['formatted_total'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function recurringInvoice()
    {
        return $this->belongsTo('BT\Modules\RecurringInvoices\Models\RecurringInvoice');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->recurringInvoice->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->recurringInvoice->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->recurringInvoice->currency);
    }

    public function getFormattedDiscountAttribute()
    {
        return CurrencyFormatter::format($this->attributes['discount'], $this->recurringInvoice->currency);
    }

    /**
     * Retrieve the formatted total prior to conversion.
     * @return string
     */
    public function getFormattedTotalWithoutConversionAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'] / $this->recurringInvoice->exchange_rate);
    }
}
