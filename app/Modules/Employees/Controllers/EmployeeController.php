<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Employees\Controllers;

use BT\Modules\Employees\Models\Employee;
use BT\Modules\Employees\Requests\EmployeeRequest;
use BT\Http\Controllers\Controller;
use BT\Modules\ItemLookups\Models\ItemLookup;
use BT\Modules\Titles\Models\Title;
use BT\Traits\ReturnUrl;
use BT\DataTables\EmployeesDataTable;

class EmployeeController extends Controller
{
    use ReturnUrl;

    /**
     * Display a listing of the resource.
     *
     */
    public function index(EmployeesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = (request('status')) ?: 'all';

        return $dataTable->render('employees.index',['status' => $status]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = Title::pluck('name', 'id');

        return view('employees.create', compact('titles'))
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeRequest $request)
    {
        // store
        $employees = new Employee;
        $employees->number = $request->number;
        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        //handled by mutator
        $employees->full_name = null;
        $employees->short_name = null;
        //
        $employees->title = $request->title;
        $employees->billing_rate = $request->billing_rate?:0;
        $employees->schedule = $request->schedule?$request->schedule:0;
        $employees->active = $request->active?$request->active:0;
        $employees->driver = $request->driver?$request->driver:0;
        $employees->save();

        if (config('bt.emptolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        return redirect($this->getReturnUrl())->with('alertInfo', trans('bt.create_employee_success'));
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
     */
    public function edit($id)
    {
        // get the employee
        $employees = Employee::find($id);
        $titles = Title::pluck('name', 'id');


        // show the edit form and pass the resource
        return view('employees.edit', compact('employees','titles'))
            ->with('returnUrl', $this->getReturnUrl());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeRequest $request, $id)
    {
        // update
        $employees = Employee::find($id);
        $employees->number = $request->number;
        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        //handled by mutator
        $employees->full_name = null;
        $employees->short_name = null;
        //
        $employees->title = $request->title;
        $employees->billing_rate = $request->billing_rate;
        $employees->schedule = $request->schedule ? $request->schedule : 0;
        $employees->active = $request->active ? $request->active : 0;
        $employees->driver = $request->driver ? $request->driver : 0;
        $employees->save();

        if (config('bt.emptolup')==1){
            $ret=1;
            $this->forceLUTupdate($ret);
        }

        // redirect
        return redirect($this->getReturnUrl())->with('alertInfo', trans('bt.edit_employee_success'));
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

    /**
     * @param $ret
     * @return \Illuminate\Http\RedirectResponse
     */
    public function  forceLUTupdate($ret)
    {

        ItemLookup::where('resource_table', 'employees')->delete();
        $employees = Employee::where('active', 1)->get(['short_name', 'title', 'number', 'billing_rate', 'id']);
        foreach ($employees as $employee){
            $itemlookup = new ItemLookup();
            $itemlookup->name = $employee->short_name;
            $itemlookup->description = $employee->title . "-" . $employee->number;
            $itemlookup->price = $employee->billing_rate;
            $itemlookup->resource_table = 'employees';
            $itemlookup->resource_id = $employee->id;

            $itemlookup->save();
        }

        if ($ret == 0){return redirect()->route('settings.index')
            ->with('alertSuccess', trans('bt.lut_updated'));}
    }

    public function getEmployee()
    {
        $employees = Employee::where('active', 1)->orderby('short_name','ASC')->get();

        return view('employees.modal_employees')
            ->with('employees',$employees);

    }

    public function processEmployee(){

        $items = Employee::whereIn('id', request('employee_ids'))->get();

        foreach ($items as $item){
            $item->resource_table = 'employees';
            $item->resource_id = $item->id;
        }

        echo json_encode($items);
    }

}
