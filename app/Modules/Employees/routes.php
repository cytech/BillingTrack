<?php

Route::group(['middleware' => ['web', 'auth.admin'], 'prefix' => 'employees', 'namespace' => 'BT\Modules\Employees\Controllers'], function () {
//employees

    Route::get('/', ['uses' => 'EmployeeController@index', 'as' => 'employees.index']);
    Route::get('{id}/edit', ['uses' => 'EmployeeController@edit', 'as' => 'employees.edit']);
    Route::put('{id}/edit', ['uses' => 'EmployeeController@update', 'as' => 'employees.update']);
    Route::get('create', ['uses' => 'EmployeeController@create', 'as' => 'employees.create']);
    Route::post('create', ['uses' => 'EmployeeController@store', 'as' => 'employees.store']);

});
