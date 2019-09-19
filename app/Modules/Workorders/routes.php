<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Workorders\Controllers')->group(function () {
    Route::prefix('workorders')->name('workorders.')->group(function () {
        //workorders
        Route::name('index')->get('/', 'WorkorderController@index');
        Route::name('create')->get('create', 'WorkorderCreateController@create');
        Route::name('store')->post('create', 'WorkorderCreateController@store');
        Route::name('edit')->get('{id}/edit', 'WorkorderEditController@edit');
        Route::name('update')->post('{id}/edit', 'WorkorderEditController@update');
        Route::name('delete')->get('{id}/delete', 'WorkorderController@delete');
        Route::name('pdf')->get('{id}/pdf', 'WorkorderController@pdf');
        Route::name('bulk.delete')->post('bulk/delete', 'WorkorderController@bulkDelete');
        Route::name('bulk.status')->post('bulk/status', 'WorkorderController@bulkStatus');
        //assorted
        Route::name('workorderEdit.refreshEdit')->get('{id}/edit/refresh', 'WorkorderEditController@refreshEdit');
        Route::name('workorderEdit.refreshTo')->post('edit/refresh_to', 'WorkorderEditController@refreshTo');
        Route::name('workorderEdit.refreshFrom')->post('edit/refresh_from', 'WorkorderEditController@refreshFrom');
        Route::name('workorderEdit.refreshTotals')->post('edit/refresh_totals', 'WorkorderEditController@refreshTotals');
        Route::name('workorderEdit.updateClient')->post('edit/update_client', 'WorkorderEditController@updateClient');
        Route::name('workorderEdit.updateCompanyProfile')->post('edit/update_company_profile', 'WorkorderEditController@updateCompanyProfile');
        Route::name('recalculate')->post('recalculate', 'WorkorderRecalculateController@recalculate');
    });
    //end of group workorders


    Route::prefix('workorder_copy')->name('workorderCopy.')->group(function () {
        Route::name('create')->post('create', 'WorkorderCopyController@create');
        Route::name('store')->post('store', 'WorkorderCopyController@store');
    });

    Route::prefix('workorder_to_invoice')->name('workorderToInvoice.')->group(function () {
        Route::name('create')->post('create', 'WorkorderToInvoiceController@create');
        Route::name('store')->post('store', 'WorkorderToInvoiceController@store');
    });

    Route::prefix('workorder_mail')->name('workorderMail.')->group(function () {
        Route::name('create')->post('create', 'WorkorderMailController@create');
        Route::name('store')->post('store', 'WorkorderMailController@store');
    });

    Route::prefix('workorder_item')->name('workorderItem.')->group(function () {
        Route::name('delete')->post('delete', 'WorkorderItemController@delete');
    });

});
Route::middleware(['web', 'auth.admin'])->group(function () {
//resource and employee force update
    Route::get('/forceProductUpdate/{ret}', 'BT\Modules\Products\Controllers\ProductController@forceLUTupdate');
    Route::get('/forceEmployeeUpdate/{ret}', 'BT\Modules\Employees\Controllers\EmployeeController@forceLUTupdate');
});
