<?php


/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

	protected $table = 'products';

    public function quoteitem()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\QuoteItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function workorderitem()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\WorkorderItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function invoiceitem()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\InvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function recurringinvoiceitem()
    {
        return $this->belongsTo('FI\Modules\Workorders\Models\RecurringInvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }
}
