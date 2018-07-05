<?php

Route::group(['middleware' => ['web', 'auth.admin'], 'prefix' => 'time_tracking', 'namespace' => 'FI\Modules\TimeTracking\Controllers'], function ()
{
    Route::group(['prefix' => 'projects'], function ()
    {
        Route::get('/', ['uses' => 'ProjectController@index', 'as' => 'timeTracking.projects.index']);
        Route::get('create', ['uses' => 'ProjectController@create', 'as' => 'timeTracking.projects.create']);
        Route::post('create', ['uses' => 'ProjectController@store', 'as' => 'timeTracking.projects.store']);
        Route::get('{id}/edit', ['uses' => 'ProjectController@edit', 'as' => 'timeTracking.projects.edit']);
        Route::post('{id}/edit', ['uses' => 'ProjectController@update', 'as' => 'timeTracking.projects.update']);
        Route::get('{id}/delete', ['uses' => 'ProjectController@delete', 'as' => 'timeTracking.projects.delete']);
        Route::post('refresh_task_list', ['uses' => 'ProjectController@refreshTaskList', 'as' => 'timeTracking.projects.refreshTaskList']);
        Route::post('refresh_totals', ['uses' => 'ProjectController@refreshTotals', 'as' => 'timeTracking.projects.refreshTotals']);
        Route::post('bulk/delete', ['uses' => 'ProjectController@bulkDelete', 'as' => 'timeTracking.projects.bulk.delete']);
        Route::post('bulk/status', ['uses' => 'ProjectController@bulkStatus', 'as' => 'timeTracking.projects.bulk.status']);
    });

    Route::group(['prefix' => 'tasks'], function ()
    {
        Route::post('create', ['uses' => 'TaskController@create', 'as' => 'timeTracking.tasks.create']);
        Route::post('store', ['uses' => 'TaskController@store', 'as' => 'timeTracking.tasks.store']);
        Route::post('edit', ['uses' => 'TaskController@edit', 'as' => 'timeTracking.tasks.edit']);
        Route::post('update', ['uses' => 'TaskController@update', 'as' => 'timeTracking.tasks.update']);
        Route::post('delete', ['uses' => 'TaskController@delete', 'as' => 'timeTracking.tasks.delete']);
        Route::post('update_display_order', ['uses' => 'TaskController@updateDisplayOrder', 'as' => 'timeTracking.tasks.updateDisplayOrder']);
    });

    Route::group(['prefix' => 'timers'], function ()
    {
        Route::post('start', ['uses' => 'TimerController@start', 'as' => 'timeTracking.timers.start']);
        Route::post('stop', ['uses' => 'TimerController@stop', 'as' => 'timeTracking.timers.stop']);
        Route::post('show', ['uses' => 'TimerController@show', 'as' => 'timeTracking.timers.show']);
        Route::post('seconds', ['uses' => 'TimerController@seconds', 'as' => 'timeTracking.timers.seconds']);
        Route::post('store', ['uses' => 'TimerController@store', 'as' => 'timeTracking.timers.store']);
        Route::post('delete', ['uses' => 'TimerController@delete', 'as' => 'timeTracking.timers.delete']);
        Route::post('refresh_list', ['uses' => 'TimerController@refreshList', 'as' => 'timeTracking.timers.refreshList']);
    });

    Route::group(['prefix' => 'bill'], function ()
    {
        Route::post('create', ['uses' => 'TaskBillController@create', 'as' => 'timeTracking.bill.create']);
        Route::post('store', ['uses' => 'TaskBillController@store', 'as' => 'timeTracking.bill.store']);
    });

    Route::group(['prefix' => 'reports'], function ()
    {
        Route::get('timesheet', ['uses' => 'TimesheetReportController@index', 'as' => 'timeTracking.reports.timesheet']);
        Route::post('timesheet/validate', ['uses' => 'TimesheetReportController@ajaxValidate', 'as' => 'timeTracking.reports.timesheet.validate']);
        Route::get('timesheet/html', ['uses' => 'TimesheetReportController@html', 'as' => 'timeTracking.reports.timesheet.html']);
        Route::get('timesheet/pdf', ['uses' => 'TimesheetReportController@pdf', 'as' => 'timeTracking.reports.timesheet.pdf']);
    });
});