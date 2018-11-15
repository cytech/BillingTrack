<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Controllers;

use FI\DataTables\WorkordersDataTable;
use FI\Events\WorkorderModified;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Workorders\Models\Workorder;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\WorkorderStatuses;
use FI\Traits\ReturnUrl;


class WorkorderController extends Controller
{
    use ReturnUrl;

    public function index(WorkordersDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = WorkorderStatuses::listsAllFlat();
        $keyedStatuses = collect(WorkorderStatuses::lists())->except(3);
        $companyProfiles = ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('workorders.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Workorder::destroy($id);

        return redirect()->route('workorders.index')
            ->with('alert', trans('fi.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Workorder::destroy(request('ids'));
        return response()->json(['success' => trans('fi.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
	    Workorder::whereIn('id', request('ids'))->update(['workorder_status_id' => request('status')]);

	    foreach (request('ids') as $cid){
		    $workorder = Workorder::findOrFail($cid);
	    	event(new WorkorderModified($workorder));
	    }
        return response()->json(['success' => trans('fi.status_successfully_updated')], 200);

    }

    public function pdf($id)
    {
        $workorder = Workorder::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($workorder->html, FileNames::workorder($workorder));
    }

}