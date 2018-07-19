<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Models;

use Addons\Workorders\Events\WorkorderItemSaving;
use Addons\Workorders\Events\WorkorderModified;
use FI\Support\CurrencyFormatter;
use FI\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class WorkorderItem extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($workorderItem)
        {
            $workorderItem->amount()->delete();
        });

        static::deleted(function($workorderItem)
        {
            if ($workorderItem->workorder)
            {
                event(new WorkorderModified($workorderItem->workorder));
            }
        });

        static::saving(function($workorderItem)
        {
            event(new WorkorderItemSaving($workorderItem));
        });

        static::saved(function($workorderItem)
        {
            event(new WorkorderModified($workorderItem->workorder));
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function amount()
    {
        return $this->hasOne('Addons\Workorders\Models\WorkorderItemAmount', 'item_id');
    }

    public function workorder()
    {
        return $this->belongsTo('Addons\Workorders\Models\Workorder');
    }

    public function taxRate()
    {
        return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate');
    }

    public function taxRate2()
    {
        return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id');
    }

    //TODO check
    public function resources()
    {
        return $this->hasMany('Addons\Workorders\Models\Resource', 'resource_id')
            ->where('resource_table','=','resources');
    }
    //TODO check
    public function employees()
    {
        return $this->hasMany('Addons\Workorders\Models\Employee', 'resource_id')
            ->where('resource_table','=','employees');
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