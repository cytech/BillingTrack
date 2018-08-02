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
use FI\Modules\Scheduler\Models\Schedule;
use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use FI\Modules\Workorders\Models\Workorder;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use Illuminate\Http\Request;

class UtilityController
{
    public function manageTrash()
    {
        $clients = Client::onlyTrashed()->get();
        $quotes = Quote::has('client')->where('invoice_id', 0)->onlyTrashed()->get();
        $workorders = Workorder::has('client')->where('invoice_id', 0)->onlyTrashed()->get();
        $invoices = Invoice::has('client')->onlyTrashed()->get();
        $recurring_invoices = RecurringInvoice::has('client')->onlyTrashed()->get();
        $payments = Payment::has('client')->has('invoice')->onlyTrashed()->get();
        $expenses = Expense::onlyTrashed()->get();
        $projects = TimeTrackingProject::has('client')->onlyTrashed()->get();
        $schedules = Schedule::onlyTrashed()->get();

        return view('utilities.trash')
            ->with('clients', $clients)
            ->with('quotes', $quotes)
            ->with('workorders', $workorders)
            ->with('invoices', $invoices)
            ->with('recurring_invoices', $recurring_invoices)
            ->with('payments', $payments)
            ->with('expenses', $expenses)
            ->with('projects', $projects)
            ->with('schedules', $schedules);

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
            case 'workorder':
                Workorder::onlyTrashed()->find($id)->restore();
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
            case 'schedule':
                Schedule::onlyTrashed()->find($id)->restore();
                break;
        }

        return back()->with('alertSuccess', trans('fi.record_successfully_restored'));
    }

    public function batchPrint(Request $request)
    {
        if ($request->isMethod('post')) {
            $start = $request->from_date;
            $end = $request->to_date;
            //dd($request->batch_type);
            switch ($request->batch_type){
                case 'quotes':
                    //quotes sent or approved, not converted to workorder or invoice
                    $batchtypes = Quote::whereBetween('quote_date', [$start, $end])
                        ->whereBetween('quote_status_id', [2,3])
                        ->where('invoice_id', 0)->where('workorder_id', 0)->get();
                    break;
                case 'workorders':
                    //workorders sent or approved, not converted to invoice
                    $batchtypes = Workorder::whereBetween('job_date', [$start, $end])
                        ->whereBetween('workorder_status_id', [2,3])
                        ->where('invoice_id', 0)->get();
                    break;
                case 'invoices':
                    //invoices sent (not paid)
                    $batchtypes = Invoice::whereBetween('invoice_date', [$start, $end])
                        ->where('invoice_status_id', 2)->get();
                    break;
            }


            if (!count($batchtypes)) {
                return redirect()->route('utilities.batchprint')
                    ->with('alert', trans('fi.batch_nodata_alert'));
            }

            $pdf = PDFFactory::create();
            $wohtml = [];
            $counter = 1;
            foreach ($batchtypes as $batchtype) {
                $wohtml[$counter] = $batchtype->html;
                $counter++;
            }

            $pdf->download($wohtml, FileNames::batchprint());

        } else {
            return view('utilities.getdates');
        }
    }

}
