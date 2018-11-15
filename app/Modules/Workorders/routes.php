<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Workorders\Controllers'], function () {
    Route::group(['prefix' => 'workorders'], function () {
    	//workorders
        Route::get('/', ['uses' => 'WorkorderController@index', 'as' => 'workorders.index']);
        Route::get('create', ['uses' => 'WorkorderCreateController@create', 'as' => 'workorders.create']);
        Route::post('create', ['uses' => 'WorkorderCreateController@store', 'as' => 'workorders.store']);
        Route::get('{id}/edit', ['uses' => 'WorkorderEditController@edit', 'as' => 'workorders.edit']);
        Route::post('{id}/edit', ['uses' => 'WorkorderEditController@update', 'as' => 'workorders.update']);
        Route::get('{id}/delete', ['uses' => 'WorkorderController@delete', 'as' => 'workorders.delete']);
        Route::get('{id}/pdf', ['uses' => 'WorkorderController@pdf', 'as' => 'workorders.pdf']);
        Route::post('bulk/delete', ['uses' => 'WorkorderController@bulkDelete', 'as' => 'workorders.bulk.delete']);
        Route::post('bulk/status', ['uses' => 'WorkorderController@bulkStatus', 'as' => 'workorders.bulk.status']);
		//assorted
        Route::get('{id}/edit/refresh', ['uses' => 'WorkorderEditController@refreshEdit', 'as' => 'workorderEdit.refreshEdit']);
        Route::post('edit/refresh_to', ['uses' => 'WorkorderEditController@refreshTo', 'as' => 'workorderEdit.refreshTo']);
        Route::post('edit/refresh_from', ['uses' => 'WorkorderEditController@refreshFrom', 'as' => 'workorderEdit.refreshFrom']);
        Route::post('edit/refresh_totals', ['uses' => 'WorkorderEditController@refreshTotals', 'as' => 'workorderEdit.refreshTotals']);
        Route::post('edit/update_client', ['uses' => 'WorkorderEditController@updateClient', 'as' => 'workorderEdit.updateClient']);
        Route::post('edit/update_company_profile', ['uses' => 'WorkorderEditController@updateCompanyProfile', 'as' => 'workorderEdit.updateCompanyProfile']);
        Route::post('recalculate', ['uses' => 'WorkorderRecalculateController@recalculate', 'as' => 'workorders.recalculate']);
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
//resource and employee force update
Route::get('/forceProductUpdate/{ret}', 'FI\Modules\Products\Controllers\ProductController@forceLUTupdate');
Route::get('/forceEmployeeUpdate/{ret}', 'FI\Modules\Employees\Controllers\EmployeeController@forceLUTupdate');
});
