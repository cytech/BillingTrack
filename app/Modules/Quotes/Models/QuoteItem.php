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

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteItem extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

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
        return $this->hasOne('BT\Modules\Quotes\Models\QuoteItemAmount', 'item_id');
    }

    public function quote()
    {
        return $this->belongsTo('BT\Modules\Quotes\Models\Quote');
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
        return $this->hasMany('BT\Modules\Products\Models\Product', 'resource_id')
            ->where('resource_table','=','products');
    }

    public function employees()
    {
        return $this->hasMany('BT\Modules\Employees\Models\Employee', 'resource_id')
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
        return CurrencyFormatter::format($this->attributes['price'], $this->quote->currency);
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->attributes['description']);
    }
}
