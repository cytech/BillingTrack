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

}
