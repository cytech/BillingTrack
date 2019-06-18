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

use BT\Http\Controllers\Controller;
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
        $input = $request->except('vendor_name');

        $input['vendor_id']    = Vendor::firstOrCreateByName($request->input('vendor_name'))->id;
        $input['purchaseorder_date'] = DateFormatter::unformat($input['purchaseorder_date']);

        $purchaseorder = Purchaseorder::create($input);

        return response()->json(['id' => $purchaseorder->id], 200);
    }
}
