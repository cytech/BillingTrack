<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Controllers;

use Addons\Workorders\Events\WorkorderModified;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use Addons\Workorders\Models\Workorder;
use Addons\Workorders\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\QuoteStatuses;
use FI\Traits\ReturnUrl;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class WorkorderController extends Controller
{
    use ReturnUrl;

    public function dashboard(){

	    $today = new Carbon();

	    $data['workorders'] = Workorder::where( 'job_date', '=', $today->format('Y-m-d'))
	                                   ->where('workorder_status_id', 3)->get();

	    $data['fullMonthEvent'] = Workorder::select( DB::raw( "count('id') as total,job_date" ) )
	                                      ->where( 'job_date', '>=', date( 'Y-m-01' ) )
	                                      ->where( 'job_date', '<=', date( 'Y-m-t' ) )
		                                  ->where('workorder_status_id', 3)
	                                      ->groupBy( DB::raw( "DATE_FORMAT(job_date, '%Y%m%d')" ) )
	                                      ->get();

	    return view('Workorders::workorders.dashboard', $data);
    }

    public function index()
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');

        $workorders = Workorder::select('workorders.*')
            ->join('clients', 'clients.id', '=', 'workorders.client_id')
            ->join('workorder_amounts', 'workorder_amounts.workorder_id', '=', 'workorders.id')
            ->with(['client', 'activities', 'amount.workorder.currency'])
            ->status($status)
            ->keywords(request('search'))
            ->clientId(request('client'))
            ->companyProfileId(request('company_profile'))
            //->sortable(['job_date' => 'desc', 'LENGTH(number)' => 'desc', 'number' => 'desc'])
            ->get();//->paginate(config('fi.resultsPerPage'));

        return view('Workorders::workorders.workorderTable')
            ->with('workorders', $workorders)
            ->with('status', $status)
            ->with('statuses', QuoteStatuses::listsAllFlat())
            ->with('statuslist', QuoteStatuses::statuses())//why??? above works for quotes but passes weird array in WO. Static??
	        ->with('keyedStatuses', QuoteStatuses::lists())//added 2017-11
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList())
            ->with('displaySearch', false);
    }

    public function bulkStatus()
    {
	    Workorder::whereIn('id', request('ids'))->update(['workorder_status_id' => request('status')]);

	    foreach (request('ids') as $cid){
		    $workorder = Workorder::findOrFail($cid);
	    	event(new WorkorderModified($workorder));
	    }

    }

    public function pdf($id)
    {
        $workorder = Workorder::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($workorder->html, FileNames::workorder($workorder));
    }

    public function batchPrint(Request $request)
    {
        if ($request->isMethod('post')) {
            $start = $request->start_date;
            $end = $request->end_date;
            $workorders = Workorder::whereBetween('job_date', [$start, $end])->where('workorder_status_id', 3)->where('invoice_id', 0)->get();

            if (!count($workorders)) {
                return redirect()->route('workorders.batchprint')
                    ->with('alert', trans('Workorders::texts.batch_nodata_alert'));
            }

            $pdf = PDFFactory::create();
            $wohtml = [];
            $counter = 1;
            foreach ($workorders as $workorder) {
                $wohtml[$counter] = $workorder->html;
                $counter++;
            }

            $pdf->download($wohtml, FileNames::batchprint());

        } else {
            if (config('fi.pdfDriver') == 'wkhtmltopdf') {
                return view('Workorders::workorders.getdates',['title' => 'BatchPrint']);
            } else {
                return redirect()->to('/settings#tab-pdf')
                    ->with('alert', trans('Workorders::texts.batch_wkhtml_alert'));
            }

        }
    }


}