<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ClientCenter\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Payments\Models\Payment;

class ClientCenterPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice.amount.invoice.currency', 'invoice.client')
            ->whereHas('invoice', function ($invoice)
            {
                $invoice->where('client_id', auth()->user()->client->id);
            })->orderBy('created_at', 'desc')
            ->paginate(config('bt.resultsPerPage'));

        return view('client_center.payments.index')
            ->with('payments', $payments);
    }
}
