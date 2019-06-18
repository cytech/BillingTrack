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
use BT\Modules\Purchaseorders\Models\PurchaseorderItem;
use BT\Modules\Purchaseorders\Requests\PurchaseorderStoreRequest;
use BT\Support\DateFormatter;

class PurchaseorderCopyController extends Controller
{
    public function create()
    {
        $purchaseorder = Purchaseorder::find(request('purchaseorder_id'));

        return view('purchaseorders._modal_copy')
            ->with('purchaseorder', $purchaseorder)
            ->with('groups', Group::getList())
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('purchaseorder_date', DateFormatter::format())
            ->with('user_id', auth()->user()->id);
    }

    public function store(PurchaseorderStoreRequest $request)
    {
        $vendor = Vendor::firstOrCreateByName($request->input('vendor_name'));

        $fromPurchaseorder = Purchaseorder::find($request->input('purchaseorder_id'));

        $toPurchaseorder = Purchaseorder::create([
            'vendor_id'          => $vendor->id,
            'company_profile_id' => $request->input('company_profile_id'),
            'purchaseorder_date'       => DateFormatter::unformat(request('purchaseorder_date')),
            'group_id'           => $request->input('group_id'),
            'currency_code'      => $fromPurchaseorder->currency_code,
            'exchange_rate'      => $fromPurchaseorder->exchange_rate,
            'terms'              => $fromPurchaseorder->terms,
            'footer'             => $fromPurchaseorder->footer,
            'template'           => $fromPurchaseorder->template,
            'summary'            => $fromPurchaseorder->summary,
            'discount'           => $fromPurchaseorder->discount,
        ]);

        foreach ($fromPurchaseorder->items as $item)
        {
            PurchaseorderItem::create([
                'purchaseorder_id'    => $toPurchaseorder->id,
                'name'          => $item->name,
                'description'   => $item->description,
                'quantity'      => $item->quantity,
                'cost'         => $item->cost,
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
                //'resource_table' => $item->resource_table,
                //'resource_id'    => $item->resource_id,
                'display_order' => $item->display_order,
            ]);
        }

        // Copy the custom fields
        $custom = collect($fromPurchaseorder->custom)->except('purchaseorder_id')->toArray();
        $toPurchaseorder->custom->update($custom);

        return response()->json(['id' => $toPurchaseorder->id], 200);
    }
}
