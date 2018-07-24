<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => 'auth.api'], function () {
    Route::group(['prefix' => 'woapi', 'namespace' => 'FI\Modules\Workorders\Controllers'], function () {
        Route::post('workorders/list', ['uses' => 'ApiWorkorderController@lists']);
        Route::post('workorders/show', ['uses' => 'ApiWorkorderController@show']);
        Route::post('workorders/create', ['uses' => 'ApiWorkorderController@create']);
        Route::post('workorders/items/add', ['uses' => 'ApiWorkorderController@addItem']);
        Route::post('workorders/delete', ['uses' => 'ApiWorkorderController@delete']);
    });
});

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Workorders\Controllers'], function () {
//    Route::get('item_lookups/ajax/get_item_lookup', ['uses' => 'ItemLookupController@getItemLookup', 'as' => 'itemLookups.ajax.getItemLookup']);
//    Route::post('item_lookups/ajax/process_item_lookup', ['uses' => 'ItemLookupController@processItemLookup', 'as' => 'itemLookups.ajax.processItemLookup']);
//    Route::get('item_lookupswo/ajax/item_lookup', ['uses' => 'ItemLookupController@ajaxItemLookup', 'as' => 'itemLookupswo.ajax.itemLookup']);

    Route::group(['prefix' => 'workorders'], function () {
    	//workorders
	    //Route::get('/', ['uses' => 'WorkorderController@dashboard', 'as' => 'workorders.dashboard']);
        Route::get('/', ['uses' => 'WorkorderController@index', 'as' => 'workorders.index']);
        Route::get('create', ['uses' => 'WorkorderCreateController@create', 'as' => 'workorders.create']);
        Route::post('create', ['uses' => 'WorkorderCreateController@store', 'as' => 'workorders.store']);
        Route::get('{id}/edit', ['uses' => 'WorkorderEditController@edit', 'as' => 'workorders.edit']);
        Route::post('{id}/edit', ['uses' => 'WorkorderEditController@update', 'as' => 'workorders.update']);
        Route::get('{id}/delete', ['uses' => 'WorkorderController@delete', 'as' => 'workorders.delete']);
        Route::get('{id}/pdf', ['uses' => 'WorkorderController@pdf', 'as' => 'workorders.pdf']);
        Route::post('bulk/delete', ['uses' => 'WorkorderController@bulkDelete', 'as' => 'workorders.bulk.delete']);
        Route::post('bulk/status', ['uses' => 'WorkorderController@bulkStatus', 'as' => 'workorders.bulk.status']);
		//employees
//	    Route::group(['prefix' => 'employees'], function () {
//		    Route::get('/', ['uses' => 'EmployeeController@index', 'as' => 'employees.index']);
//		    Route::get('{id}/edit', ['uses' => 'EmployeeController@edit', 'as' => 'employees.edit']);
//		    Route::put('{id}/edit', ['uses' => 'EmployeeController@update', 'as' => 'employees.update']);
//		    Route::get('create', ['uses' => 'EmployeeController@create', 'as' => 'employees.create']);
//		    Route::post('create', ['uses' => 'EmployeeController@store', 'as' => 'employees.store']);
//	    });
		//resources
//	    Route::group(['prefix' => 'resources'], function () {
//		    Route::get('/', ['uses' => 'ResourceController@index', 'as' => 'resources.index']);
//		    Route::get('{id}/edit', ['uses' => 'ResourceController@edit', 'as' => 'resources.edit']);
//		    Route::put('{id}/edit', ['uses' => 'ResourceController@update', 'as' => 'resources.update']);
//		    Route::get('create', ['uses' => 'ResourceController@create', 'as' => 'resources.create']);
//		    Route::post('create', ['uses' => 'ResourceController@store', 'as' => 'resources.store']);
//	    });
		//timesheet
	    Route::group(['prefix' => 'timesheet'], function () {
	    	//prefix is injecting id in workorder route if using base routes below
		    Route::any('/', ['uses' => 'TimeSheetController@index', 'as' => 'timesheets.index']);
		    Route::get('about', ['uses' => 'TimeSheetController@about', 'as' => 'timesheets.about']);
		    Route::get('report', ['uses' => 'TimeSheetController@report', 'as' => 'timesheets.report']);
		    Route::post('report/validate', ['uses' => 'TimeSheetController@ajaxValidate', 'as' => 'timesheets.validate']);
		    Route::get('report/html', ['uses' => 'TimeSheetController@html', 'as' => 'timesheets.html']);
		    Route::get('report/pdf', ['uses' => 'TimeSheetController@pdf', 'as' => 'timesheets.pdf']);
		    Route::get('report/iif', ['uses' => 'TimeSheetController@iif', 'as' => 'timesheets.iif']);
	    });
		//enhanced report - client statement
	    Route::group(['prefix' => 'report'], function () {
	        Route::get('client_statement', ['uses' => 'ClientStatementReportController@index', 'as' => 'clientStatement.report']);
	        Route::post('client_statement/validate', ['uses' => 'ClientStatementReportController@validateOptions', 'as' => 'clientStatement.validate']);
	        Route::get('client_statement/html', ['uses' => 'ClientStatementReportController@html', 'as' => 'clientStatement.html']);
	        Route::get('client_statement/pdf', ['uses' => 'ClientStatementReportController@pdf', 'as' => 'clientStatement.pdf']);
	    });
		//batchprint workorders pdf
        Route::any('batchprint', ['uses' => 'WorkorderController@batchPrint', 'as' => 'workorders.batchprint']);
		//workorders about page
        Route::get('about', [function () {return view('workorders.about');}, 'as' => 'workorders.about']);
		//workorder settings
        Route::get('settings', ['uses' => 'SettingController@index', 'as' => 'workorders.settings']);
        Route::post('settings/update', ['uses' => 'SettingController@update', 'as' => 'workorders.settings.update']);
		//assorted
        Route::get('{id}/edit/refresh', ['uses' => 'WorkorderEditController@refreshEdit', 'as' => 'workorderEdit.refreshEdit']);
        Route::post('edit/refresh_to', ['uses' => 'WorkorderEditController@refreshTo', 'as' => 'workorderEdit.refreshTo']);
        Route::post('edit/refresh_from', ['uses' => 'WorkorderEditController@refreshFrom', 'as' => 'workorderEdit.refreshFrom']);
        Route::post('edit/refresh_totals', ['uses' => 'WorkorderEditController@refreshTotals', 'as' => 'workorderEdit.refreshTotals']);
        Route::post('edit/update_client', ['uses' => 'WorkorderEditController@updateClient', 'as' => 'workorderEdit.updateClient']);
        Route::post('edit/update_company_profile', ['uses' => 'WorkorderEditController@updateCompanyProfile', 'as' => 'workorderEdit.updateCompanyProfile']);
        Route::post('recalculate', ['uses' => 'WorkorderRecalculateController@recalculate', 'as' => 'workorders.recalculate']);
	    //Route::post('bulk/status', ['uses' => 'WorkorderController@bulkStatus', 'as' => 'workorders.bulk.status']);
		//resource and employee force update

		//trash
//        Route::get('trash',['uses' => 'TrashController@trash', 'as' => 'workorders.trash']);
//	    Route::get( '{id}/trash_workorder', [ 'uses' => 'TrashController@trashWorkorder', 'as' => 'workorders.trashworkorder' ] );
//	    Route::get( 'restore_all_trash', [ 'uses' => 'TrashController@restoreAllTrash', 'as'   => 'workorders.restorealltrash' ] );
//	    Route::get( 'delete_all_trash', [ 'uses' => 'TrashController@deleteAllTrash', 'as'   => 'workorders.deletealltrash' ] );
//	    Route::get( 'restore_single_trash', [ 'uses' => 'TrashController@restoreSingleTrash', 'as'   =>'workorders.restoresingletrash' ] );
//	    Route::get( 'delete_single_trash', [ 'uses' => 'TrashController@deleteSingleTrash', 'as'   =>'workorders.deletesingletrash' ] );
//
//	    Route::post('bulk/trash', ['uses' => 'TrashController@bulkTrash', 'as' => 'workorders.bulk.trash']);
//	    Route::post('bulk/delete_trash', ['uses' => 'TrashController@bulkDeleteTrash', 'as' => 'workorders.bulk.deletetrash']);
//	    Route::post('bulk/restore_trash', ['uses' => 'TrashController@bulkRestoreTrash', 'as' => 'workorders.bulk.restoretrash']);

	    Route::get('/viewclear', [function () {
		    Artisan::call('view:clear');
		    return redirect()->route('workorders.dashboard');
	    }]);

    });
    //end of group workorders


    Route::group(['prefix' => 'workorder_copy'], function () {
        Route::post('create', ['uses' => 'WorkorderCopyController@create', 'as' => 'workorderCopy.create']);
        Route::post('store', ['uses' => 'WorkorderCopyController@store', 'as' => 'workorderCopy.store']);
    });

    Route::group(['prefix' => 'workorder_to_invoice'], function () {
        Route::post('create', ['uses' => 'WorkorderToInvoiceController@create', 'as' => 'workorderToInvoice.create']);
        Route::post('store', ['uses' => 'WorkorderToInvoiceController@store', 'as' => 'workorderToInvoice.store']);
    });

    Route::group(['prefix' => 'workorder_mail'], function () {
        Route::post('create', ['uses' => 'WorkorderMailController@create', 'as' => 'workorderMail.create']);
        Route::post('store', ['uses' => 'WorkorderMailController@store', 'as' => 'workorderMail.store']);
    });

    Route::group(['prefix' => 'workorder_item'], function () {
        Route::post('delete', ['uses' => 'WorkorderItemController@delete', 'as' => 'workorderItem.delete']);
    });

});
Route::group(['middleware' => ['web', 'auth.admin']], function () {
Route::get('/forceProductUpdate/{ret}', 'FI\Modules\Products\Controllers\ProductController@forceLUTupdate');
Route::get('/forceEmployeeUpdate/{ret}', 'FI\Modules\Employees\Controllers\EmployeeController@forceLUTupdate');
});
