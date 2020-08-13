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

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use BT\Support\DateFormatter;
use Ifsnop\Mysqldump\Mysqldump;
use Illuminate\Http\Request;
use BT\Modules\Quotes\Models\Quote;
use BT\Modules\Workorders\Models\Workorder;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Scheduler\Models\Schedule;

class BackupController extends Controller
{
    public function index(){
        return view('utilities._backup')
            ->with('quotecount', Quote::onlyTrashed()->count())
            ->with('workordercount', Workorder::onlyTrashed()->count())
            ->with('invoicecount', Invoice::onlyTrashed()->count())
            ->with('purchaseordercount', Purchaseorder::onlyTrashed()->count())
            ->with('schedulecount', Schedule::onlyTrashed()->count());
    }
    public function database()
    {
        $default  = config('database.default');
        $host     = config('database.connections.' . $default . '.host');
        $dbname   = config('database.connections.' . $default . '.database');
        $username = config('database.connections.' . $default . '.username');
        $password = config('database.connections.' . $default . '.password');
        $filename = storage_path('BillingTrack_' . date('Y-m-d_H-i-s') . '.sql');

        $dump = new Mysqldump('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
        $dump->start($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function trashPrior(Request $request)
    {
        $maxtime = ini_get('max_execution_time');
        ini_set('max_execution_time', 0);
        $date = DateFormatter::unformat($request->trashprior_date);
        $module = $request->trashprior_module;
        if ($module == 'Schedule') {
            $className = '\BT\Modules\\' . $module . 'r\Models\\' . $module;
            $className::whereHas('occurrences', function ($q) use ($date) {
                $q->where('end_date', '<', $date);
            })->delete();

        } else {
            $className = '\BT\Modules\\' . $module . 's\Models\\' . $module;
            $datefield = strtolower($module) . '_date';
            $className::where($datefield, '<', $date)->delete();

        }

        ini_set('max_execution_time', $maxtime);

        return back()->with('alertSuccess', trans('bt.record_successfully_trashed'));
    }

    public function deletePrior(Request $request)
    {
        $maxtime = ini_get('max_execution_time');
        ini_set('max_execution_time', 0);

        $date = DateFormatter::unformat($request->deleteprior_date);
        $module = $request->deleteprior_module;

        if ($module == 'Schedule') {
            $className = '\BT\Modules\\' . $module . 'r\Models\\' . $module;
            $className::whereHas('occurrences', function ($q) use ($date) {
                $q->onlyTrashed()->where('end_date', '<', $date);
            })->onlyTrashed()->forceDelete();

        } else {
            $className = '\BT\Modules\\' . $module . 's\Models\\' . $module;
            $datefield = strtolower($module) . '_date';
            $className::where($datefield, '<', $date)->onlyTrashed()->forceDelete();
        }

        ini_set('max_execution_time', $maxtime);

        return back()->with('alertSuccess', trans('bt.record_successfully_deleted'));
    }

    public function clientInactivePrior (Request $request) {
        $maxtime = ini_get('max_execution_time');
        ini_set('max_execution_time', 0);

        $date = DateFormatter::unformat($request->clientprior_date);
        // find all clients with activity after $date
        $active_quote = Quote::distinct('client_id')->where('quote_date', '>=', $date)->pluck('client_id','client_id');
        $active_workorder = Workorder::distinct('client_id')->where('workorder_date', '>=', $date)->pluck('client_id','client_id');
        $active_invoice = Invoice::distinct('client_id')->where('invoice_date', '>=', $date)->pluck('client_id','client_id');
        $active_recurringinvoice = RecurringInvoice::distinct('client_id')->where('next_date', '>=', $date)->pluck('client_id','client_id');
        $active_payment = Payment::distinct('client_id')->where('paid_at', '>=', $date)->pluck('client_id','client_id');
        $active_expense = Expense::distinct('client_id')->where('expense_date', '>=', $date)->pluck('client_id','client_id');
        $active_project = TimeTrackingProject::distinct('client_id')->where('due_at', '>=', $date)->pluck('client_id','client_id');
        //union above
        $results = $active_quote->union($active_workorder)->union($active_invoice)->union($active_recurringinvoice)
            ->union($active_payment)->union($active_expense)->union($active_project);
        //get all clients
        $clients = Client::pluck('id','id');
        //get client ids to set as inactive
        $inactiveclients = $clients->diff($results);

        $setinactive = Client::whereIn('id', $inactiveclients)->where('active', 1)->get();

        foreach ($setinactive as $client){
            $client->active = 0;
            $client->save();
        }

        ini_set('max_execution_time', $maxtime);

        return back()->with('alertSuccess', $setinactive->count().' Clients set to Inactive');

    }

}
