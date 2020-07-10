<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Scheduler\Controllers')
    ->prefix('scheduler')->name('scheduler.')->group(function () {
        Route::name('index')->get('/', 'SchedulerController@index');
        Route::name('fullcalendar')->get('/fullcalendar', 'SchedulerController@calendar');
        Route::name('showschedule')->get('/showschedule', 'SchedulerController@showSchedule');
        Route::name('showschedule')->post('/showschedule', 'SchedulerController@showSchedule');

        Route::name('create')->get('/create_event', 'SchedulerController@editEvent');
        //ajax post
        Route::name('updateevent')->any('/update_event/{id?}', 'SchedulerController@updateEvent');
        Route::name('tableevent')->get('/table_event', 'SchedulerController@tableEvent');
        //clone route solely for breadcrumbs...
        Route::name('tableeventcreate')->get('/table_event/create_event', 'SchedulerController@editEvent');
        //clone route solely for breadcrumbs...
        Route::name('tableeventedit')->get('/table_event/edit_event/{id?}', 'SchedulerController@editEvent');
        Route::name('tablerecurringevent')->get('/table_recurring_event', 'SchedulerController@tableRecurringEvent');
        //clone route solely for breadcrumbs...
        Route::name('createrecurringevent')->get('/table_recurring_event/create_recurring_event', 'SchedulerController@editRecurringEvent');
        Route::name('editrecurringevent')->get('/table_recurring_event/edit_recurring_event/{id?}', 'SchedulerController@editRecurringEvent');
        Route::name('updaterecurringevent')->any('/table_recurring_event/update_recurring_event/{id?}', 'SchedulerController@updateRecurringEvent');
        //trash
        Route::name('trashevent')->get('/trash_event/{id}', 'SchedulerController@trashEvent');
        Route::name('trashreminder')->get('/trash_reminder/{id}', 'SchedulerController@trashReminder');
        Route::name('bulk.trash')->post('bulk/trash', 'SchedulerController@bulkTrash');
        //categories
        //laravel 5.3 changed route resource and prefix to something stupid..
        //Route::resource( 'categories', 'SchedulerCategoryController' );
        Route::name('categories.index')->get('/categories', 'SchedulerCategoryController@index');
        Route::name('categories.create')->get('/categories/create', 'SchedulerCategoryController@create');
        Route::name('categories.store')->post('/categories/store', 'SchedulerCategoryController@store');
        Route::name('categories.show')->get('/categories/{id}', 'SchedulerCategoryController@show');
        Route::name('categories.edit')->get('/categories/{id}/edit', 'SchedulerCategoryController@edit');
        Route::name('categories.update')->put('/categories/{id}', 'SchedulerCategoryController@update');
        Route::name('categories.delete')->get('categories/delete/{id}', 'SchedulerCategoryController@delete');
        //utilities
        Route::name('checkschedule')->get('/checkschedule', 'SchedulerController@checkSchedule');
        Route::name('getreplace.employee')->get('/getreplaceemployee/{item_id}/{name}/{date}', 'SchedulerController@getReplaceEmployee');
        Route::name('setreplace.employee')->post('/setreplaceemployee', 'SchedulerController@setReplaceEmployee');
        //route for ajax calc of human readable recurrence frequency
        Route::name('gethuman')->post('/get_human', 'SchedulerController@getHuman');
        //other ajax
        Route::name('search.customer')->get('/ajax/customer', 'SearchController@customer');
        Route::name('search.employee')->get('/ajax/employee', 'SearchController@employee');
        Route::name('api.createwo')->post('/api/createwo', 'WorkorderController@create');
        //route to pass available resources to ajax in _js_event.blade
        Route::name('getresources')->get('/getResources/{date}', 'SchedulerController@scheduledResources');

    });

