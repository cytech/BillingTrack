<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ItemLookups\Models;

use BT\Modules\Employees\Models\Employee;
use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemLookup extends Model
{

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['formatted_name', 'formatted_price'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function taxRate()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate')->withDefault(['name' => '']);
    }

    public function taxRate2()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id')->withDefault(['name' => '']);
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

    public function getFormattedPriceAttribute()
    {
        return CurrencyFormatter::format($this->attributes['price']);
    }

    public function getFormattedNumericPriceAttribute()
    {
        return NumberFormatter::format($this->attributes['price']);
    }

    //format drivers blue
    public function getFormattedNameAttribute()
    {
        if ($this->resource_table == 'employees'){
            if (Employee::find($this->resource_id)->driver == 1){
                return '<span style = "color:blue">'.$this->name.'</span>';
            }
            return $this->name;
        }
        return $this->name;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeKeywords($query, $keywords)
    {
        if ($keywords)
        {
            $keywords = explode(' ', $keywords);

            foreach ($keywords as $keyword)
            {
                if ($keyword)
                {
                    $keyword = strtolower($keyword);

                    $query->where(DB::raw("CONCAT_WS('^',LOWER(name),LOWER(description),price)"), 'LIKE', "%$keyword%");
                }
            }
        }

        return $query;
    }
}
