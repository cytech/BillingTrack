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

use BT\Support\CurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteAmount extends Model
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

    public function quote()
    {
        return $this->belongsTo('BT\Modules\Quotes\Models\Quote');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->quote->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->quote->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->quote->currency);
    }

    public function getFormattedDiscountAttribute()
    {
        return CurrencyFormatter::format($this->attributes['discount'], $this->quote->currency);
    }

    /**
     * Retrieve the formatted total prior to conversion.
     * @return string
     */
    public function getFormattedTotalWithoutConversionAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'] / $this->quote->exchange_rate);
    }
}
