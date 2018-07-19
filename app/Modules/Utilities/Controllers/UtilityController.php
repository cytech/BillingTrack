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
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Payments\Models\Payment;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use Illuminate\Http\Request;


class UtilityController
{
    public function manageTrash()
    {
        $clients = Client::onlyTrashed()->get();
        $quotes = Quote::has('client')->where('invoice_id', 0)->onlyTrashed()->get();
        $invoices = Invoice::has('client')->onlyTrashed()->get();
        $recurring_invoices = RecurringInvoice::has('client')->onlyTrashed()->get();
        $payments = Payment::has('client')->has('invoice')->onlyTrashed()->get();
        $expenses = Expense::onlyTrashed()->get();
        $projects = TimeTrackingProject::has('client')->onlyTrashed()->get();

        return view('utilities.trash')
            ->with('clients', $clients)
            ->with('quotes', $quotes)
            ->with('invoices', $invoices)
            ->with('recurring_invoices', $recurring_invoices)
            ->with('payments', $payments)
            ->with('expenses', $expenses)
            ->with('projects', $projects);

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
            case 'expense':
                Expense::onlyTrashed()->find($id)->restore();
                break;
            case 'project':
                TimeTrackingProject::onlyTrashed()->find($id)->restore();
                break;
        }

        return back()->with('alertSuccess', trans('fi.record_successfully_restored'));
    }

}
