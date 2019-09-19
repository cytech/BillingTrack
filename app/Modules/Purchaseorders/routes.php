<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Purchaseorders\Controllers')->group(function () {
    Route::prefix('purchaseorders')->name('purchaseorders.')->group(function () {
        Route::name('index')->get('/', 'PurchaseorderController@index');
        Route::name('create')->get('create', 'PurchaseorderCreateController@create');
        Route::name('store')->post('create', 'PurchaseorderCreateController@store');
        Route::name('edit')->get('{id}/edit', 'PurchaseorderEditController@edit');
        Route::name('update')->post('{id}/edit', 'PurchaseorderEditController@update');
        Route::name('delete')->get('{id}/delete', 'PurchaseorderController@delete');
        Route::name('pdf')->get('{id}/pdf', 'PurchaseorderController@pdf');
        Route::name('ajaxLookup')->get('ajaxLookup/{name}', 'PurchaseorderController@ajaxLookup');
        Route::name('receive')->post('receive', 'PurchaseorderController@receive');
        Route::name('receive_items')->post('receive_items', 'PurchaseorderController@receiveItems');

        Route::name('purchaseorderEdit.refreshEdit')->get('{id}/edit/refresh', 'PurchaseorderEditController@refreshEdit');
        Route::name('purchaseorderEdit.refreshTo')->post('edit/refresh_to', 'PurchaseorderEditController@refreshTo');
        Route::name('purchaseorderEdit.refreshFrom')->post('edit/refresh_from', 'PurchaseorderEditController@refreshFrom');
        Route::name('purchaseorderEdit.refreshTotals')->post('edit/refresh_totals', 'PurchaseorderEditController@refreshTotals');
        Route::name('purchaseorderEdit.updateVendor')->post('edit/update_vendor', 'PurchaseorderEditController@updateVendor');
        Route::name('purchaseorderEdit.updateCompanyProfile')->post('edit/update_company_profile', 'PurchaseorderEditController@updateCompanyProfile');
        Route::name('recalculate')->post('recalculate', 'PurchaseorderRecalculateController@recalculate');
        Route::name('bulk.delete')->post('bulk/delete', 'PurchaseorderController@bulkDelete');
        Route::name('bulk.status')->post('bulk/status', 'PurchaseorderController@bulkStatus');
    });

    Route::prefix('purchaseorder_copy')->name('purchaseorderCopy.')->group(function () {
        Route::name('create')->post('create', 'PurchaseorderCopyController@create');
        Route::name('store')->post('store', 'PurchaseorderCopyController@store');
    });

    Route::prefix('purchaseorder_mail')->name('purchaseorderMail.')->group(function () {
        Route::name('create')->post('create', 'PurchaseorderMailController@create');
        Route::name('store')->post('store', 'PurchaseorderMailController@store');
    });

    Route::prefix('purchaseorder_item')->name('purchaseorderItem.')->group(function () {
        Route::name('delete')->post('delete', 'PurchaseorderItemController@delete');
    });
});
