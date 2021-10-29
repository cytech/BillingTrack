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

use BT\Events\PurchaseorderModified;
use BT\Http\Controllers\Controller;
use BT\Modules\Products\Models\Product;
use BT\Modules\Vendors\Models\Vendor;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Modules\Purchaseorders\Requests\PurchaseorderStoreRequest;
use BT\Support\DateFormatter;

class PurchaseorderCreateController extends Controller
{
    public function create()
    {
        return view('purchaseorders._modal_create')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('groups', Group::getList());
    }

    public function store(PurchaseorderStoreRequest $request)
    {
        $input = $request->except('vendor_name', 'productid');

        $input['vendor_id'] = Vendor::firstOrCreateByName($request->input('vendor_name'))->id;
        $input['purchaseorder_date'] = DateFormatter::unformat($input['purchaseorder_date']);

        $purchaseorder = Purchaseorder::create($input);
        // if request from PO create
        if ($request->input('productid')) {
            $poitem = Product::find($request->input('productid'));
            $poitems = [
                'resource_table' => 'products',
                'resource_id'    => $poitem->id,
                'name'           => $poitem->name,
                'description'    => $poitem->description,
                'quantity'       => ($poitem->numstock < 0 ? abs($poitem->numstock) : 1),
                'cost'           => $poitem->cost
            ];
            $purchaseorder->purchaseorderItems()->create($poitems);
            event(new PurchaseorderModified($purchaseorder));
        }
        return response()->json(['id' => $purchaseorder->id], 200);
    }
}
