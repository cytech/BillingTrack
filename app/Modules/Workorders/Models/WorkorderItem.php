<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkorderItem extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $softCascade = ['amount'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function amount()
    {
        return $this->hasOne('BT\Modules\Workorders\Models\WorkorderItemAmount', 'item_id');
    }

    public function workorder()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\Workorder');
    }

    public function taxRate()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate');
    }

    public function taxRate2()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id');
    }

    public function products()
    {
        return $this->hasMany('BT\Modules\Products\Models\Product', 'id', 'resource_id');
    }

    public function employees()
    {
        return $this->hasMany('BT\Modules\Employees\Models\Employee', 'id', 'resource_id');
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
        return CurrencyFormatter::format($this->attributes['price'], $this->workorder->currency);
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->attributes['description']);
    }
}
