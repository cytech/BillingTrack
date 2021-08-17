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
use BT\Modules\Products\Models\Product;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;
use BT\Support\FileNames;
use BT\Support\PDF\PDFFactory;
use BT\Support\Statuses\PurchaseorderItemStatuses;
use BT\Support\Statuses\PurchaseorderStatuses;
use BT\Traits\ReturnUrl;
use Illuminate\Http\Request;

class PurchaseorderController extends Controller
{
    use ReturnUrl;

    public function index(PurchaseordersDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = PurchaseorderStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];
        $keyedStatuses = collect(PurchaseorderStatuses::lists());
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

    public function receive(){

        $items = PurchaseorderItem::where('purchaseorder_id', request('purchaseorder_id'))->get();
        return view('purchaseorders._modal_receive')
            ->with('items', $items);
    }

    public function receiveItems(Request $request)
    {
        $items = PurchaseorderItem::whereIn('id', $request->itemrec_ids)->get();

        $rec_cnt = 0;
        $rec_qty = 0;

        // update received info
        foreach ($items as $item) {
            foreach ($request->itemrec_att as $att) {
                if ($att['id'] == $item->id) {
                    $qty = $item->rec_qty + $att['rec_qty'];
                    $cost = $att['rec_cost'];
                    $rec_qty = $att['rec_qty'];

                    if ($qty == $item->quantity) {
                        $status_id = PurchaseorderItemStatuses::getStatusId('received');
                        $rec_cnt ++;
                    } elseif ($qty == 0) {
                        $status_id = PurchaseorderItemStatuses::getStatusId('open');
                    } elseif ($qty < $item->quantity) {
                        $status_id = PurchaseorderItemStatuses::getStatusId('partial');
                    } elseif ($qty > $item->quantity) {
                        $status_id = PurchaseorderItemStatuses::getStatusId('extra');
                    } else {
                        $status_id = PurchaseorderItemStatuses::getStatusId('canceled');
                    }
                }
            }

            $item->rec_status_id = $status_id;
            $item->rec_qty = $qty;
            $item->cost = $cost;
            $item->save();

            //if update products is checked
            if ($request->itemrec) {
                //update product table quantities and cost for items
                if ($item->resource_table == 'products' && $item->resource_id) {
                    $item->product->increment('numstock', $rec_qty, ['cost' => $item->cost]);
                }
            }
        }

        // change PO status to received/partial
        $purchaseorder = Purchaseorder::where('id', $items->first()->purchaseorder_id)->first();
        if ($rec_cnt == $items->count()) {
            $purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('received');
        }else{
            $purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('partial');
        }
        $purchaseorder->save();
    }
}
