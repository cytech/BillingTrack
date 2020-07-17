<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Utilities\Controllers;

use BT\DataTables\ClientsTrashDataTable;
use BT\DataTables\ExpensesTrashDataTable;
use BT\DataTables\InvoicesTrashDataTable;
use BT\DataTables\PaymentsTrashDataTable;
use BT\DataTables\ProjectsTrashDataTable;
use BT\DataTables\PurchaseordersTrashDataTable;
use BT\DataTables\QuotesTrashDataTable;
use BT\DataTables\RecurringInvoicesTrashDataTable;
use BT\DataTables\SchedulerTrashDataTable;
use BT\DataTables\WorkordersTrashDataTable;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Workorders\Models\Workorder;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use Illuminate\Http\Request;

class UtilityController
{
    public function manageTrash()
    {
        $ctdt = new ClientsTrashDataTable();
        $qtdt = new QuotesTrashDataTable();
        $wtdt = new WorkordersTrashDataTable();
        $itdt = new InvoicesTrashDataTable();
        $ritdt = new RecurringInvoicesTrashDataTable();
        $podt = new PurchaseordersTrashDataTable();
        $pytdt = new PaymentsTrashDataTable();
        $etdt = new ExpensesTrashDataTable();
        $pjtdt = new ProjectsTrashDataTable();
        $stdt = new SchedulerTrashDataTable();

        /*$clients = Client::onlyTrashed()->get();
        $quotes = Quote::has('client')->where('invoice_id', 0)->onlyTrashed()->get();
        $workorders = Workorder::has('client')->where('invoice_id', 0)->onlyTrashed()->get();
        $invoices = Invoice::has('client')->onlyTrashed()->get();
        $recurring_invoices = RecurringInvoice::has('client')->onlyTrashed()->get();
        $payments = Payment::has('client')->has('invoice')->onlyTrashed()->get();
        $expenses = Expense::onlyTrashed()->get();
        $projects = TimeTrackingProject::has('client')->onlyTrashed()->get();
        $schedules = Schedule::onlyTrashed()->get();*/

        $status = (request('status')) ?: 'all';

        $trash_tables = compact('ctdt', 'qtdt', 'wtdt', 'itdt', 'ritdt', 'podt', 'pytdt', 'etdt', 'pjtdt', 'stdt', 'status');

        if (request()->get('table') == 'clients') {
            return $ctdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'quotes') {
            return $qtdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'workorders') {
            return $wtdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'invoices') {
            return $itdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'recurring_invoices') {
            return $ritdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'purchaseorders') {
            return $podt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'payments') {
            return $pytdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'expenses') {
            return $etdt->render('utilities.trash', $trash_tables);
        }
        if (request()->get('table') == 'projects') {
            return $pjtdt->render('utilities.trash', $trash_tables);
        }
        //scheduler
        return $stdt->render('utilities.trash', $trash_tables);
    }

    /**
     * @param $id
     * @param $entity fully qualified classname passed from _action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreTrash($id, $entity)
    {

        $entity::onlyTrashed()->find($id)->restore();

        return back()->with('alertSuccess', trans('bt.record_successfully_restored'));
    }

    /**
     * @param $id
     * @param $entity fully qualified classname passed from _action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTrash($id, $entity)
    {
        $entity::onlyTrashed()->find($id)->forceDelete();

        return back()->with('alertSuccess', trans('bt.record_successfully_deleted'));
    }

    public function bulkRestoreTrash()
    {
        $request = request('ids');
        foreach ($request as $arr) {
            foreach ($arr as $entity => $id) {
                if ($entity == 'Schedule') {
                    $instance = 'BT\\Modules\\Scheduler\\Models\\' . $entity;
                }elseif  ($entity == 'TimeTrackingProject'){
                    $instance = 'BT\\Modules\\TimeTracking\\Models\\' . $entity;
                }else {
                    $instance = 'BT\\Modules\\' . $entity . 's\\Models\\' . $entity;
                }

                $instance::onlyTrashed()->find($id)->restore();
            }
        }
        return response()->json(['success' => trans('bt.record_successfully_restored')], 200);
    }

    public function bulkDeleteTrash()
    {
        $request = request('ids');

        foreach ($request as $arr) {
            foreach ($arr as $entity => $id) {
                if ($entity == 'Schedule') {
                    $instance = 'BT\\Modules\\Scheduler\\Models\\' . $entity;
                }elseif  ($entity == 'TimeTrackingProject'){
                    $instance = 'BT\\Modules\\TimeTracking\\Models\\' . $entity;
                } else {
                    $instance = 'BT\\Modules\\' . $entity . 's\\Models\\' . $entity;
                }

                $instance::onlyTrashed()->find($id)->forceDelete();
            }
        }
        return response()->json(['success' => trans('bt.record_successfully_deleted')], 200);
    }

    public function batchPrint(Request $request)
    {
        if ($request->isMethod('post')) {
            $start = $request->from_date;
            $end = $request->to_date;

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
                    ->with('alert', trans('bt.batch_nodata_alert'));
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
            return view('utilities.batchprint', ['title' => 'Batch Print']);
        }
    }

    public function saveTab()
    {
        session(['trashTabId' => request('trashTabId')]);
    }

}
