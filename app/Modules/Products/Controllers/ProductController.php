<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Products\Controllers;

use BT\Modules\Categories\Models\Category;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\Products\Models\InventoryType;
use BT\Modules\Products\Models\Product;
use BT\Modules\Products\Requests\ProductRequest;
use BT\Http\Controllers\Controller;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Modules\Vendors\Models\Vendor;
use BT\Support\NumberFormatter;
use BT\Traits\ReturnUrl;
use BT\DataTables\ProductsDataTable;

class ProductController extends Controller
{
    use ReturnUrl;
    /**
     * Display a listing of the product.
     *
     */
    public function index(ProductsDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = (request('status')) ?: 'all';

        return $dataTable->render('products.index',['status' => $status]);
    }

    /**
     * Show the form for creating a new product.
     *
     */
    public function create()
    {
        //pass tracked types to select box highlighted
        $invtracked = [];
        $invs = InventoryType::where('tracked', 1)->get();
        foreach ($invs as $inv){
            $invtracked[$inv->id] = ['style' => 'background-color:lightgray'];
        }

        return view('products.create')
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('categories', Category::pluck('name', 'id'))
            ->with('inventorytypes', InventoryType::pluck('name', 'id'))
            ->with('optionAttributes', $invtracked)
            ->with('returnUrl', $this->getReturnUrl())
            ->with('taxRates', TaxRate::getList());
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        // store
        $products = new Product;

        if ($request->category) {
            $products->category_id = Category::firstOrCreate(['name' => $request->category])->id;
        }
        if ($request->vendor) {
            $products->vendor_id = Vendor::firstOrCreate(['name' => $request->vendor])->id;
        }

        $products->name = $request->name;
        $products->description = $request->description;
        $products->serialnum = $request->serialnum;
        $products->price = $request->price ?:0;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost ?:0;
        $products->inventorytype_id = $request->type;
        $products->numstock = $request->numstock ?:0;
        $products->tax_rate_id = $request->tax_rate_id;
        $products->tax_rate_2_id = $request->tax_rate_2_id;
        $products->save();

        if (config('bt.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }


        return redirect($this->getReturnUrl())->with('alertInfo', trans('bt.create_product_success'));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //pass tracked types to select box highlighted
        $invtracked = [];
        $invs = InventoryType::where('tracked', 1)->get();
        foreach ($invs as $inv){
            $invtracked[$inv->id] = ['style' => 'background-color:lightgray'];
        }

        // get the product
        $products = Product::find($id);

        // show the edit form and pass the product
        return view('products.edit', compact('products'))
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('categories', Category::pluck('name', 'id'))
            ->with('inventorytypes', InventoryType::pluck('name', 'id'))
            ->with('taxRates', TaxRate::getList())
            ->with('optionAttributes', $invtracked)
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id)
    {
        // update
        $products = Product::find($id);

        if ($request->category) {
            $products->category_id = Category::firstOrCreate(['name' => $request->category])->id;
        }else{
            $products->category_id = null;
        }
        if ($request->vendor) {
            $products->vendor_id = Vendor::firstOrCreate(['name' => $request->vendor])->id;
        }else{
            $products->vendor_id = null;
        }

        $products->name = $request->name;
        $products->description = $request->description;
        $products->serialnum = $request->serialnum;
        $products->price = $request->price;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost;
        $products->inventorytype_id = $request->type;
        $products->numstock = $request->numstock;
        $products->tax_rate_id = $request->tax_rate_id;
        $products->tax_rate_2_id = $request->tax_rate_2_id;
        $products->save();

        if (config('bt.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        // redirect
        return redirect($this->getReturnUrl())->with('alertInfo', trans('bt.edit_product_success'));
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

    //force lookuptable update
    public function  forceLUTupdate($ret)
    {
        ItemLookup::where('resource_table', 'products')->delete();
        $products = Product::where('active', 1)->get(['name', 'description', 'price', 'tax_rate_id', 'tax_rate_2_id','id']);
        foreach ($products as $product){
            $itemlookup = new ItemLookup();
            $itemlookup->name = $product->name;
            $itemlookup->description = $product->description;
            $itemlookup->price = $product->price;
            $itemlookup->tax_rate_id = $product->tax_rate_id ?:0;
            $itemlookup->tax_rate_2_id = $product->tax_rate_2_id ?:0;
            $itemlookup->resource_table = 'products';
            $itemlookup->resource_id = $product->id;

            $itemlookup->save();
        }

        if ($ret == 0){return redirect()->route('settings.index')
            ->with('alertInfo', trans('bt.lut_updated'));}
    }

    public function getProduct($vendorId)
    {
        $products = Product::where('active', 1)->orderby('name','ASC')->get();
        $vendor =  Vendor::where('id', $vendorId)->first();
        $vname = $vendor ? $vendor->name : 0; //ignore vendor if not initiated from purchase order

        return view('products.modal_products')
            ->with('products',$products)
            ->with('vendorId', $vendorId)
            ->with('vname', $vname);

    }

    public function processProduct(){

        $items = Product::whereIn('id', request('product_ids'))->get();

        foreach ($items as $item){
            $item->resource_table = 'products';
            $item->resource_id = $item->id;
        }

        echo json_encode($items);
    }

    public function ajaxProduct()
    {

        $items = Product::orderBy('name')->where('active', 1)->where('name', 'like', '%' . request('term') . '%')->get();

        $list = [];

        foreach ($items as $item)
        {
            $list[] = [
                'value'         => $item->name, //for autocomplete
                'name'          => $item->name,
                'description'   => $item->description,
                'price'         => NumberFormatter::format($item->price),
                'cost'         => NumberFormatter::format($item->cost),
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
            ];
        }

        return json_encode($list);
    }
}
