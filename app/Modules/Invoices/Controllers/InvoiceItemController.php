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

class InvoiceItemController extends Controller
{
    public function delete()
    {
        InvoiceItem::destroy(request('id'));
    }
}
