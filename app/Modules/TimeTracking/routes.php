<?php

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\TimeTracking\Controllers')
    ->prefix('time_tracking')->name('timeTracking.')->group(function () {
        Route::prefix('projects')->group(function () {
            Route::name('projects.index')->get('/', 'ProjectController@index');
            Route::name('projects.create')->get('create', 'ProjectController@create');
            Route::name('projects.store')->post('create', 'ProjectController@store');
            Route::name('projects.edit')->get('{id}/edit', 'ProjectController@edit');
            Route::name('projects.update')->post('{id}/edit', 'ProjectController@update');
            Route::name('projects.delete')->get('{id}/delete', 'ProjectController@delete');
            Route::name('projects.refreshTaskList')->post('refresh_task_list', 'ProjectController@refreshTaskList');
            Route::name('projects.refreshTotals')->post('refresh_totals', 'ProjectController@refreshTotals');
            Route::name('projects.bulk.delete')->post('bulk/delete', 'ProjectController@bulkDelete');
            Route::name('projects.bulk.status')->post('bulk/status', 'ProjectController@bulkStatus');
        });

        Route::prefix('tasks')->group(function () {
            Route::name('tasks.create')->post('create', 'TaskController@create');
            Route::name('tasks.store')->post('store', 'TaskController@store');
            Route::name('tasks.edit')->post('edit', 'TaskController@edit');
            Route::name('tasks.update')->post('update', 'TaskController@update');
            Route::name('tasks.delete')->post('delete', 'TaskController@delete');
            Route::name('tasks.updateDisplayOrder')->post('update_display_order', 'TaskController@updateDisplayOrder');
        });

        Route::prefix('timers')->group(function () {
            Route::name('timers.start')->post('start', 'TimerController@start');
            Route::name('timers.stop')->post('stop', 'TimerController@stop');
            Route::name('timers.show')->post('show', 'TimerController@show');
            Route::name('timers.seconds')->post('seconds', 'TimerController@seconds');
            Route::name('timers.store')->post('store', 'TimerController@store');
            Route::name('timers.delete')->post('delete', 'TimerController@delete');
            Route::name('timers.refreshList')->post('refresh_list', 'TimerController@refreshList');
        });

        Route::prefix('bill')->group(function () {
            Route::name('bill.create')->post('create', 'TaskBillController@create');
            Route::name('bill.store')->post('store', 'TaskBillController@store');
        });

    });
