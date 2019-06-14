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
use BT\Modules\Products\Models\Product;
use BT\Modules\Products\Requests\ProductRequest;
use BT\Http\Controllers\Controller;
use BT\Modules\Vendors\Models\Vendor;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $products = Product::get();

        return view('products.index')
            ->with('products', $products)
            ->with('categories', Category::pluck('name', 'id'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('categories', Category::pluck('name', 'id'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $products->price = $request->price?:0;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost?:0;
        $products->type = $request->type;
        $products->numstock = $request->numstock?:0;
        $products->save();

        if (config('bt.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }


        return redirect()->route('products.index')->with('alertInfo', trans('bt.create_product_success'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the product
        $products = Product::find($id);

        // show the edit form and pass the product
        return view('products.edit', compact('products'))
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('categories', Category::pluck('name', 'id'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // update
        $products = Product::find($id);

        if ($request->category) {
            $products->category_id = Category::firstOrCreate(['name' => $request->category])->id;
        }
        if ($request->vendor) {
            $products->vendor_id = Vendor::firstOrCreate(['name' => $request->vendor])->id;
        }

        $products->name = $request->name;
        $products->description = $request->description;
        $products->serialnum = $request->serialnum;
        $products->price = $request->price;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost;
        $products->type = $request->type;
        $products->numstock = $request->numstock;
        $products->save();

        if (config('bt.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        // redirect
        return redirect()->route('products.index')->with('alertInfo', trans('bt.edit_product_success'));
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
        $products = Product::where('active', 1)->get(['name', 'description', 'price', 'id']);
        foreach ($products as $product){
            $itemlookup = new ItemLookup();
            $itemlookup->name = $product->name;
            $itemlookup->description = $product->description;
            $itemlookup->price = $product->price;
            $itemlookup->resource_table = 'products';
            $itemlookup->resource_id = $product->id;

            $itemlookup->save();
        }

        if ($ret == 0){return redirect()->route('settings.index')
            ->with('alertInfo', trans('bt.lut_updated'));}
    }
}
