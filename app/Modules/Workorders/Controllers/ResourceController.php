<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Controllers;

use Addons\Workorders\Models\Resource;
use Addons\Workorders\Requests\ResourceRequest;
use DB;
use FI\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $resources = Resource::get();
        
        return view('resources.index')->with('resources', $resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceRequest $request)
    {
        // store
        $resources = new Resource;
        $resources->name = $request->name;
        $resources->description = $request->description;
        $resources->serialnum = $request->serialnum;
        $resources->active = is_null($request->active) ? 0 : $request->active;
        $resources->cost = $request->cost;
        $resources->category = $request->category;
        $resources->type = $request->type;
        $resources->numstock = $request->numstock;
        $resources->save();

        if (config('workorder_settings.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

       
        return redirect()->route('resources.index')->with('alertSuccess', trans('Workorders::texts.create_resource_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the resource
        $resources = Resource::find($id);

        // show the edit form and pass the resource
        return view('resources.edit', compact('resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $request, $id)
    {
        // update
        /*Resource::find($id) THIS FAILS ON SAVING CHECKBOX STATE
        ->fill($request->all())
        ->save();*/
        $resources = Resource::find($id);
        $resources->name = $request->name;
        $resources->description = $request->description;
        $resources->serialnum = $request->serialnum;
        $resources->active = $request->active;
        $resources->cost = $request->cost;
        $resources->category = $request->category;
        $resources->type = $request->type;
        $resources->numstock = $request->numstock;
        $resources->save();

        if (config('workorder_settings.restolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        // redirect
        return redirect()->route('resources.index')->with('alertSuccess', trans('Workorders::texts.edit_resource_success'));
    }

    /**
     * Remove the specified resource from storage.
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
             DELETE FROM item_lookups where resource_table = \'resources\';
             INSERT INTO item_lookups (created_at,updated_at,name,description,price,category,resource_table,resource_id)
              SELECT now(),now(), name,description,cost,category,\'resources\',id
              FROM workorder_resources
              WHERE workorder_resources.active = TRUE
              Order By workorder_resources.category ASC;
        ');

        if ($ret == 0){return redirect()->route('workorders.settings')
            ->with('alertSuccess', trans('Workorders::texts.lut_updated'));}
    }
}
