<?php


/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Products\Models;

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
}
