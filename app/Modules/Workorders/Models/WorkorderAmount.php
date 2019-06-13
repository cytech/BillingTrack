<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace BT\Modules\Workorders\Models;

use BT\Support\CurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkorderAmount extends Model
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

    public function workorder()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\Workorder');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->workorder->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->workorder->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->workorder->currency);
    }

    public function getFormattedDiscountAttribute()
    {
        return CurrencyFormatter::format($this->attributes['discount'], $this->workorder->currency);
    }

    /**
     * Retrieve the formatted total prior to conversion.
     * @return string
     */
    public function getFormattedTotalWithoutConversionAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'] / $this->workorder->exchange_rate);
    }
}
