<?php


/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Products\Models;

use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

	protected $table = 'products';

    public function vendor()
    {
        return $this->belongsTo('BT\Modules\Vendors\Models\Vendor');
    }

    public function category()
    {
        return $this->belongsTo('BT\Modules\Categories\Models\Category');
    }

    public function inventorytype()
    {
        return $this->belongsTo('BT\Modules\Products\Models\InventoryType');
    }

    public function quoteitem()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\QuoteItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function workorderitem()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\WorkorderItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function invoiceitem()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\InvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function recurringinvoiceitem()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\RecurringInvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function getFormattedPriceAttribute()
    {
        return CurrencyFormatter::format($this->attributes['price']);
    }

    public function getFormattedCostAttribute()
    {
        return CurrencyFormatter::format($this->attributes['cost']);
    }

    public function getFormattedNumericPriceAttribute()
    {
        return NumberFormatter::format($this->attributes['price']);
    }

    //inventory tracked scope
    public function scopeTracked($query)
    {
        return $query->whereIn('inventorytype_id', InventoryType::where('tracked', 1)->get('id'));
    }
}
