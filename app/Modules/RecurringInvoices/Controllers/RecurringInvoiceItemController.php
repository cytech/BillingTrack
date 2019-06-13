<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\RecurringInvoices\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem;

class RecurringInvoiceItemController extends Controller
{
    public function delete()
    {
        RecurringInvoiceItem::destroy(request('id'));
    }
}
