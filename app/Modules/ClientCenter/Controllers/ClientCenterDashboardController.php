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
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Workorders\Models\Workorder;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Support\Statuses\QuoteStatuses;
use BT\Support\Statuses\WorkorderStatuses;
use Illuminate\Support\Facades\DB;

class ClientCenterDashboardController extends Controller
{
    private $invoiceStatuses;
    private $quoteStatuses;
    private $workorderStatuses;

    public function __construct(
        InvoiceStatuses $invoiceStatuses,
        QuoteStatuses $quoteStatuses,
        WorkorderStatuses $workorderStatuses)
    {
        $this->invoiceStatuses = $invoiceStatuses;
        $this->quoteStatuses   = $quoteStatuses;
        $this->workorderStatuses   = $workorderStatuses;
    }

    public function index()
    {
        $clientId = auth()->user()->client->id;

        $invoices = Invoice::with(['amount.invoice.currency', 'client'])
            ->where('client_id', $clientId)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->limit(5)->get();

        $quotes = Quote::with(['amount.quote.currency', 'client'])
            ->where('client_id', $clientId)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->limit(5)->get();

        $workorders = Workorder::with(['amount.workorder.currency', 'client'])
            ->where('client_id', $clientId)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->limit(5)->get();

        $payments = Payment::with('invoice.amount.invoice.currency', 'invoice.client')
            ->whereHas('invoice', function ($invoice) use ($clientId)
            {
                $invoice->where('client_id', $clientId);
            })->orderBy('created_at', 'desc')
            ->limit(5)->get();

        return view('client_center.index')
            ->with('invoices', $invoices)
            ->with('quotes', $quotes)
            ->with('workorders', $workorders)
            ->with('payments', $payments)
            ->with('invoiceStatuses', $this->invoiceStatuses->statuses())
            ->with('quoteStatuses', $this->quoteStatuses->statuses())
            ->with('workorderStatuses', $this->workorderStatuses->statuses());
    }

    public function redirectToLogin()
    {
        return redirect()->route('session.login');
    }
}
