<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Products\Models\Product;

class InvoiceItemController extends Controller
{
    public function delete()
    {
        $invoiceitem = InvoiceItem::find(request('id'));

        if (config('bt.updateInvProductsDefault') && $invoiceitem->is_tracked){
            $invoiceitem->product->increment('numstock', $invoiceitem->quantity);
        }
        InvoiceItem::destroy(request('id'));
    }
}
