<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Models;

use BT\Support\CurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItemAmount extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function item()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\InvoiceItem');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->item->invoice->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->item->invoice->currency);
    }

    public function getFormattedTax1Attribute()
    {
        return CurrencyFormatter::format($this->attributes['tax_1'], $this->item->invoice->currency);
    }

    public function getFormattedTax2Attribute()
    {
        return CurrencyFormatter::format($this->attributes['tax_2'], $this->item->invoice->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->item->invoice->currency);
    }
}
