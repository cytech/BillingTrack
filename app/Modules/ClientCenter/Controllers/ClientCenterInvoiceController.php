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
use BT\Support\Statuses\InvoiceStatuses;
use Illuminate\Support\Facades\DB;

class ClientCenterInvoiceController extends Controller
{
    private $invoiceStatuses;

    public function __construct(InvoiceStatuses $invoiceStatuses)
    {
        $this->invoiceStatuses = $invoiceStatuses;
    }

    public function index()
    {
        $invoices = Invoice::with(['amount.invoice.currency', 'client'])
            ->where('client_id', auth()->user()->client->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy(DB::raw('length(number)'), 'DESC')
            ->orderBy('number', 'DESC')
            ->paginate(config('bt.resultsPerPage'));

        return view('client_center.invoices.index')
            ->with('invoices', $invoices)
            ->with('invoiceStatuses', $this->invoiceStatuses->statuses());
    }
}
