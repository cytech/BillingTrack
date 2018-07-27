<?php

/**
 * This file is part of Scheduler Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


Route::group( [ 'prefix' => 'scheduler', 'middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Scheduler\Controllers' ], function () {
	Route::get( '/', [ 'uses' => 'SchedulerController@index', 'as' => 'scheduler.index' ] );
	Route::get( '/fullcalendar', [ 'uses' => 'SchedulerController@calendar', 'as' => 'scheduler.fullcalendar' ] );
	Route::get( '/create_event', [ 'uses' => 'SchedulerController@editEvent', 'as' => 'scheduler.create' ] );
	//ajax post
	Route::any( '/update_event/{id?}', [
		'uses' => 'SchedulerController@updateEvent',
		'as'   => 'scheduler.updateevent'
	] );
	Route::get( '/table_event', [ 'uses' => 'SchedulerController@tableEvent', 'as' => 'scheduler.tableevent' ] );
	//clone route solely for breadcrumbs...
	Route::get( '/table_event/create_event', [
		'uses' => 'SchedulerController@editEvent',
		'as'   => 'scheduler.tableeventcreate'
	] );
	//clone route solely for breadcrumbs...
	Route::get( '/table_event/edit_event/{id?}', [
		'uses' => 'SchedulerController@editEvent',
		'as'   => 'scheduler.tableeventedit'
	] );
	Route::get( '/table_recurring_event', [
		'uses' => 'SchedulerController@tableRecurringEvent',
		'as'   => 'scheduler.tablerecurringevent'
	] );
	//clone route solely for breadcrumbs...
	Route::get( '/table_recurring_event/create_recurring_event', [
		'uses' => 'SchedulerController@editRecurringEvent',
		'as'   => 'scheduler.createrecurringevent'
	] );
	Route::get( '/table_recurring_event/edit_recurring_event/{id?}', [
		'uses' => 'SchedulerController@editRecurringEvent',
		'as'   => 'scheduler.editrecurringevent'
	] );
	Route::any( '/table_recurring_event/update_recurring_event/{id?}', [
		'uses' => 'SchedulerController@updateRecurringEvent',
		'as'   => 'scheduler.updaterecurringevent'
	] );
	//reports
	Route::any( '/table_report', [ 'uses' => 'SchedulerController@tableReport', 'as' => 'scheduler.tablereport' ] );
	Route::any( '/calendar_report', [
		'uses' => 'SchedulerController@calendarReport',
		'as'   => 'scheduler.calendarreport'
	] );
	//trash
	Route::get( '/event_trash', [ 'uses' => 'TrashController@eventTrash', 'as' => 'scheduler.eventtrash' ] );
	Route::get( '/trash_event', [ 'uses' => 'TrashController@trashEvent', 'as' => 'scheduler.trashevent' ] );
	Route::get( '/restore_all_trash', [
		'uses' => 'TrashController@restoreAllTrash',
		'as'   => 'scheduler.restorealltrash'
	] );
	Route::get( '/delete_all_trash', [
		'uses' => 'TrashController@deleteAllTrash',
		'as'   => 'scheduler.deletealltrash'
	] );
	Route::get( '/restore_single_trash', [
		'uses' => 'TrashController@restoreSingleTrash',
		'as'   => 'scheduler.restoresingletrash'
	] );
	Route::get( '/delete_single_trash', [
		'uses' => 'TrashController@deleteSingleTrash',
		'as'   => 'scheduler.deletesingletrash'
	] );
	Route::get( '/trash_reminder', [
		'uses' => 'TrashController@trashReminder',
		'as'   => 'scheduler.trashreminder'
	] );
	Route::post('bulk/trash', ['uses' => 'TrashController@bulkTrash', 'as' => 'scheduler.bulk.trash']);
	Route::post('bulk/delete_trash', ['uses' => 'TrashController@bulkDeleteTrash', 'as' => 'scheduler.bulk.deletetrash']);
	Route::post('bulk/restore_trash', ['uses' => 'TrashController@bulkRestoreTrash', 'as' => 'scheduler.bulk.restoretrash']);
	//categories
	//laravel 5.3 changed route resource and prefix to something stupid..
	//Route::resource( 'categories', 'CategoryController' );
	Route::get('/categories', ['uses' => 'CategoryController@index', 'as' => 'scheduler.categories.index']);
	Route::get('/categories/create', ['uses' => 'CategoryController@create', 'as' => 'scheduler.categories.create']);
	Route::post('/categories/store', ['uses' => 'CategoryController@store', 'as' => 'scheduler.categories.store']);
	Route::get('/categories/{id}', ['uses' => 'CategoryController@show', 'as' => 'scheduler.categories.show']);
	Route::get('/categories/{id}/edit', ['uses' => 'CategoryController@edit', 'as' => 'scheduler.categories.edit']);
	Route::put('/categories/{id}', ['uses' => 'CategoryController@update', 'as' => 'scheduler.categories.update']);
	Route::post('categories/delete/{id}', ['uses' => 'CategoryController@delete','as' => 'scheduler.categories.delete']);
	//settings
	Route::any( '/settings', [ 'uses' => 'SchedulerController@Settings', 'as' => 'scheduler.settings' ] );
	//about
	Route::get( '/about', [
		function () {
			return view( 'schedule.about' );
		},
		'as' => 'scheduler.about'
	] );

	//route for ajax calc of human readable recurrence frequency
	Route::post( '/get_human', [ 'uses' => 'SchedulerController@getHuman', 'as' => 'scheduler.gethuman' ] );
	//other ajax
	Route::get( '/ajax/customer', [ 'uses' => 'SearchController@customer', 'as' => 'search.customer' ] );
	Route::get( '/ajax/employee', [ 'uses' => 'SearchController@employee', 'as' => 'search.employee' ] );
	Route::post( '/api/createwo', [ 'uses' => 'WorkorderController@create', 'as' => 'api.createwo' ] );
	//route to pass available resources to ajax in _js_event.blade
	Route::get( '/getResources/{date}',['uses' => 'SchedulerController@scheduledResources', 'as' => 'scheduler.getresources' ]  );

	Route::get('/viewclear', [function () {
		Artisan::call('view:clear');
		return redirect()->route('scheduler.index');
	}]);

} );

