<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Controllers;

use BT\DataTables\WorkordersDataTable;
use BT\Events\WorkorderModified;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Workorders\Models\Workorder;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use BT\Support\Statuses\WorkorderStatuses;
use BT\Traits\ReturnUrl;


class WorkorderController extends Controller
{
    use ReturnUrl;

    public function index(WorkordersDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = WorkorderStatuses::listsAllFlat();
        $keyedStatuses = collect(WorkorderStatuses::lists())->except(3);
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('workorders.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Workorder::destroy($id);

        return redirect()->route('workorders.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Workorder::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
	    Workorder::whereIn('id', request('ids'))->update(['workorder_status_id' => request('status')]);

	    foreach (request('ids') as $cid){
		    $workorder = Workorder::findOrFail($cid);
	    	event(new WorkorderModified($workorder));
	    }
        return response()->json(['success' => trans('bt.status_successfully_updated')], 200);

    }

    public function pdf($id)
    {
        $workorder = Workorder::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($workorder->html, FileNames::workorder($workorder));
    }

}
