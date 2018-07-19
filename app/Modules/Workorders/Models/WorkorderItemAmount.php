<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Addons\Workorders\Models;

use FI\Support\CurrencyFormatter;
use Illuminate\Database\Eloquent\Model;

class WorkorderItemAmount extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo('Addons\Workorders\Models\WorkorderItem');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedSubtotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['subtotal'], $this->item->workorder->currency);
    }

    public function getFormattedTaxAttribute()
    {
        return CurrencyFormatter::format($this->attributes['tax'], $this->item->workorder->currency);
    }

    public function getFormattedTotalAttribute()
    {
        return CurrencyFormatter::format($this->attributes['total'], $this->item->workorder->currency);
    }
}