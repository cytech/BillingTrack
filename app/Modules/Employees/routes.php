<?php

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Employees\Controllers')
    ->prefix('employees')->name('employees.')->group(function () {
        Route::name('index')->get('/', 'EmployeeController@index');
        Route::name('edit')->get('{id}/edit', 'EmployeeController@edit');
        Route::name('update')->put('{id}/edit', 'EmployeeController@update');
        Route::name('create')->get('create', 'EmployeeController@create');
        Route::name('store')->post('create', 'EmployeeController@store');

        Route::name('ajax.getEmployee')->get('employees/ajax/get_employee', 'EmployeeController@getEmployee');
        Route::name('ajax.processEmployee')->post('employees/ajax/process_employee', 'EmployeeController@processEmployee');
    });
