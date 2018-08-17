<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use FI\Events\WorkorderItemSaving;
use FI\Events\WorkorderModified;
use FI\Support\CurrencyFormatter;
use FI\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkorderItem extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['amount'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        /*static::deleting(function ($workorderItem)
        {
            $workorderItem->amount()->delete();
        });*/

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
        return $this->hasOne('FI\Modules\Workorders\Models\WorkorderItemAmount', 'item_id');
    }

    public function workorder()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\Workorder');
    }

    public function taxRate()
    {
        return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate');
    }

    public function taxRate2()
    {
        return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id');
    }

    public function products()
    {
        return $this->hasMany('FI\Modules\Products\Models\Product', 'id', 'resource_id');
            //->where('resource_table','=','products');
    }

    public function employees()
    {
        return $this->hasMany('FI\Modules\Employees\Models\Employee', 'id', 'resource_id');
            //->where('resource_table','=','employees');
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