<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Vendors\Controllers;

use BT\DataTables\VendorsDataTable;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\PaymentTerms\Models\PaymentTerm;
use BT\Modules\Vendors\Models\Vendor;
use BT\Http\Controllers\Controller;
use BT\Modules\Vendors\Requests\VendorStoreRequest;
use BT\Modules\Vendors\Requests\VendorUpdateRequest;
use BT\Traits\ReturnUrl;


class VendorController extends Controller
{
    use ReturnUrl;

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendorsDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = (request('status')) ?: 'all';

        return $dataTable->render('vendors.index',['status' => $status]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_terms = PaymentTerm::pluck('name', 'id');

        return view('vendors.form', compact('payment_terms'))
            ->with('editMode', false)
            ->with('customFields', CustomField::forTable('vendors')->get())
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorStoreRequest $request)
    {
        // store
        $vendor = Vendor::create($request->except('custom'));

        $vendor->custom->update($request->get('custom', []));

        return redirect()->route('vendors.show', [$vendor->id])
            ->with('alertInfo', trans('fi.record_successfully_created'));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vendorId)
    {
        $vendor = Vendor::getSelect()->find($vendorId);

        return view('vendors.view')
            ->with('vendor', $vendor)
            ->with('customFields', CustomField::forTable('vendors')->get())
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vendorId)
    {
        $vendor = Vendor::getSelect()->with(['custom'])->find($vendorId);
        $payment_terms = PaymentTerm::pluck('name', 'id');

        return view('vendors.form', compact('payment_terms'))
            ->with('editMode', true)
            ->with('vendor', $vendor)
            ->with('customFields', CustomField::forTable('vendors')->get())
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorUpdateRequest $request, $id)
    {
//        // update
        $vendor = Vendor::find($id);
        $vendor->fill($request->except('custom'));
        $vendor->save();

        $vendor->custom->update($request->get('custom', []));

        return redirect()->route('vendors.show', [$id])
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
