<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Utilities\Controllers;

use FI\Modules\Clients\Models\Client;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Payments\Models\Payment;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use Illuminate\Http\Request;


class UtilityController
{
    public function manageTrash()
    {
        $clients = Client::onlyTrashed()->get();
        $quotes = Quote::onlyTrashed()->with(['client' => function ($q){$q->withTrashed();}])->get();
        $invoices = Invoice::onlyTrashed()->with(['client' => function ($q){$q->withTrashed();}])->get();
        $recurring_invoices = RecurringInvoice::onlyTrashed()->with(['client' => function ($q){$q->withTrashed();}])->get();
        $payments = Payment::onlyTrashed()->with(['invoice' => function ($q){$q->withTrashed();}])->get();

        return view('utilities.trash')
            ->with('clients', $clients)
            ->with('quotes', $quotes)
            ->with('invoices', $invoices)
            ->with('recurring_invoices', $recurring_invoices)
            ->with('payments', $payments);

    }

    public function restoreTrash($id, $entity)
    {
        switch ($entity){

            case 'client':
                Client::onlyTrashed()->find($id)->restore();
                break;
            case 'quote':
                Quote::onlyTrashed()->find($id)->restore();
                break;
            case 'invoice':
                Invoice::onlyTrashed()->find($id)->restore();
                break;
            case 'recurring_invoice':
                RecurringInvoice::onlyTrashed()->find($id)->restore();
                break;
            case 'payment':
                Payment::onlyTrashed()->find($id)->restore();
                break;
        }

        return back()->with('alertSuccess', trans('fi.record_successfully_restored'));
    }

}
