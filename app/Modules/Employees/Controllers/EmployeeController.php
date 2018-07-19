<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Employees\Controllers;

use FI\Modules\Employees\Models\Employee;
use FI\Modules\Employees\Requests\EmployeeRequest;
use DB;
use FI\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $employees = Employee::get();
        
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // store
        $employees = new Employee;
        $employees->number = $request->number;
        $employees->first_name = ucfirst($request->first_name);
        $employees->last_name = ucfirst($request->last_name);
        $employees->full_name = $employees->first_name . ' ' .  $employees->last_name;
        $employees->short_name = $employees->first_name . ' ' . substr($employees->last_name,0,1 ) . '.';
        $employees->title = $request->title;
        $employees->billing_rate = $request->billing_rate;
        $employees->schedule = $request->schedule?$request->schedule:0;
        $employees->active = $request->active?$request->active:0;
        $employees->driver = $request->driver?$request->driver:0;
        $employees->save();

//        if (config('workorder_settings.emptolup')==1){
//            $ret=1;
//            $this->forceLUTupdate($ret);
//        }

        return redirect()->route('employees.index' )->with('alertInfo', trans('fi.create_employee_success'));
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
        // get the employee
        $employees = Employee::find($id);

        // show the edit form and pass the resource
        return view('employees.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        // update
        /*Resource::find($id) THIS FAILS ON SAVING CHECKBOX STATE
        ->fill($request->all())
        ->save();*/
        $employees = Employee::find($id);
        $employees->number = $request->number;
        $employees->first_name = ucfirst($request->first_name);
        $employees->last_name = ucfirst($request->last_name);
        $employees->full_name = $employees->first_name . ' ' .  $employees->last_name;
        $employees->short_name = $employees->first_name . ' ' . substr($employees->last_name,0,1 ) . '.';
        $employees->title = $request->title;
        $employees->billing_rate = $request->billing_rate;
        $employees->schedule = $request->schedule ? $request->schedule : 0;
        $employees->active = $request->active ? $request->active : 0;
        $employees->driver = $request->driver ? $request->driver : 0;
        $employees->save();
//        if (config('workorder_settings.emptolup')==1){
//            $ret=1;
//            $this->forceLUTupdate($ret);
//        }

        // redirect
        return redirect()->route('employees.index')->with('alertInfo', trans('fi.edit_employee_success'));
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

    public function  forceLUTupdate($ret)
    {
        DB::unprepared('
            DELETE FROM item_lookups where resource_table = \'employees\';
             INSERT INTO item_lookups (created_at,updated_at,name,description,price,category,resource_table,resource_id)
              SELECT now(),now(), short_name,
                CONCAT(title,"-",number),
                billing_rate,IF(driver=TRUE,"Driver","Worker"),\'employees\',id
              FROM workorder_employees
              WHERE workorder_employees.active = TRUE
              Order By workorder_employees.number DESC;
        ');

        if ($ret == 0){return redirect()->route('workorders.settings')
            ->with('alertSuccess', trans('Workorders::texts.lut_updated'));}
    }
}
