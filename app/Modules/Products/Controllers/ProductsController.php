<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Products\Controllers;

use FI\Modules\Products\Models\Product;
use FI\Modules\Products\Requests\ProductRequest;
use DB;
use FI\Http\Controllers\Controller;

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
        
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
        $products->name = $request->name;
        $products->description = $request->description;
        $products->serialnum = $request->serialnum;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost;
        $products->category = $request->category;
        $products->type = $request->type;
        $products->numstock = $request->numstock;
        $products->save();

        if (config('workorder_settings.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

       
        return redirect()->route('products.index')->with('alertInfo', trans('fi.create_product_success'));
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
        return view('products.edit', compact('products'));
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
        /*Product::find($id) THIS FAILS ON SAVING CHECKBOX STATE
        ->fill($request->all())
        ->save();*/
        $products = Product::find($id);
        $products->name = $request->name;
        $products->description = $request->description;
        $products->serialnum = $request->serialnum;
        $products->active = is_null($request->active) ? 0 : $request->active;
        $products->cost = $request->cost;
        $products->category = $request->category;
        $products->type = $request->type;
        $products->numstock = $request->numstock;
        $products->save();

        if (config('workorder_settings.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        // redirect
        return redirect()->route('products.index')->with('alertInfo', trans('fi.edit_product_success'));
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
        DB::unprepared('
             DELETE FROM item_lookups where product_table = \'products\';
             INSERT INTO item_lookups (created_at,updated_at,name,description,price,category,product_table,product_id)
              SELECT now(),now(), name,description,cost,category,\'products\',id
              FROM workorder_products
              WHERE workorder_products.active = TRUE
              Order By workorder_products.category ASC;
        ');

        if ($ret == 0){return redirect()->route('workorders.settings')
            ->with('alertInfo', trans('fi.lut_updated'));}
    }
}
