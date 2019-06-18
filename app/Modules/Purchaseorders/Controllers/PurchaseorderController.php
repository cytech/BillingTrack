<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Controllers;

use BT\DataTables\PurchaseordersDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use BT\Support\Statuses\PurchaseorderStatuses;
use BT\Traits\ReturnUrl;

class PurchaseorderController extends Controller
{
    use ReturnUrl;

    public function index(PurchaseordersDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = PurchaseorderStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];
        $keyedStatuses = collect(PurchaseorderStatuses::lists())->except(3);
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('purchaseorders.index', compact('status','statuses', 'keyedStatuses','companyProfiles'));
    }

    public function delete($id)
    {
        Purchaseorder::destroy($id);

        return redirect()->route('purchaseorders.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Purchaseorder::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function bulkStatus()
    {
        Purchaseorder::whereIn('id', request('ids'))
            ->where('purchaseorder_status_id', '<>', PurchaseorderStatuses::getStatusId('paid'))
            ->update(['purchaseorder_status_id' => request('status')]);
        return response()->json(['success' => trans('bt.status_successfully_updated')], 200);
    }

    public function pdf($id)
    {
        $purchaseorder = Purchaseorder::find($id);

        $pdf = PDFFactory::create();

        $pdf->download($purchaseorder->html, FileNames::purchaseorder($purchaseorder));
    }

    public function ajaxLookup($name)
    {
        $purchaseorders = Purchaseorder::whereHas( 'vendor', function ($query) use ($name){
            $query->where('name', $name);
        })->whereHas( 'amount', function ($query){
            $query->where('balance', '>', 0);
        })->sent()->get();


        $list = [];

        foreach ($purchaseorders as $purchaseorder){
            $list[] =[
            'vendor_id' => $purchaseorder->vendor->id,
            'id' => $purchaseorder->id,
            'number' => $purchaseorder->number,
            'amount' =>  $purchaseorder->amount->formatted_numeric_balance,
            'purchaseorder_date' => $purchaseorder->formatted_purchaseorder_date,
            ];
        }

        return json_encode($list);

    }
}
