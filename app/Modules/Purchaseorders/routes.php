<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'BT\Modules\Purchaseorders\Controllers'], function ()
{
    Route::group(['prefix' => 'purchaseorders'], function ()
    {
        Route::get('/', ['uses' => 'PurchaseorderController@index', 'as' => 'purchaseorders.index']);
        Route::get('create', ['uses' => 'PurchaseorderCreateController@create', 'as' => 'purchaseorders.create']);
        Route::post('create', ['uses' => 'PurchaseorderCreateController@store', 'as' => 'purchaseorders.store']);
        Route::get('{id}/edit', ['uses' => 'PurchaseorderEditController@edit', 'as' => 'purchaseorders.edit']);
        Route::post('{id}/edit', ['uses' => 'PurchaseorderEditController@update', 'as' => 'purchaseorders.update']);
        Route::get('{id}/delete', ['uses' => 'PurchaseorderController@delete', 'as' => 'purchaseorders.delete']);
        Route::get('{id}/pdf', ['uses' => 'PurchaseorderController@pdf', 'as' => 'purchaseorders.pdf']);
        Route::get('ajaxLookup/{name}', ['uses' => 'PurchaseorderController@ajaxLookup', 'as' => 'purchaseorders.ajaxLookup']);

        Route::get('{id}/edit/refresh', ['uses' => 'PurchaseorderEditController@refreshEdit', 'as' => 'purchaseorderEdit.refreshEdit']);
        Route::post('edit/refresh_to', ['uses' => 'PurchaseorderEditController@refreshTo', 'as' => 'purchaseorderEdit.refreshTo']);
        Route::post('edit/refresh_from', ['uses' => 'PurchaseorderEditController@refreshFrom', 'as' => 'purchaseorderEdit.refreshFrom']);
        Route::post('edit/refresh_totals', ['uses' => 'PurchaseorderEditController@refreshTotals', 'as' => 'purchaseorderEdit.refreshTotals']);
        Route::post('edit/update_vendor', ['uses' => 'PurchaseorderEditController@updateVendor', 'as' => 'purchaseorderEdit.updateVendor']);
        Route::post('edit/update_company_profile', ['uses' => 'PurchaseorderEditController@updateCompanyProfile', 'as' => 'purchaseorderEdit.updateCompanyProfile']);
        Route::post('recalculate', ['uses' => 'PurchaseorderRecalculateController@recalculate', 'as' => 'purchaseorders.recalculate']);
        Route::post('bulk/delete', ['uses' => 'PurchaseorderController@bulkDelete', 'as' => 'purchaseorders.bulk.delete']);
        Route::post('bulk/status', ['uses' => 'PurchaseorderController@bulkStatus', 'as' => 'purchaseorders.bulk.status']);
    });

    Route::group(['prefix' => 'purchaseorder_copy'], function ()
    {
        Route::post('create', ['uses' => 'PurchaseorderCopyController@create', 'as' => 'purchaseorderCopy.create']);
        Route::post('store', ['uses' => 'PurchaseorderCopyController@store', 'as' => 'purchaseorderCopy.store']);
    });

    Route::group(['prefix' => 'purchaseorder_mail'], function ()
    {
        Route::post('create', ['uses' => 'PurchaseorderMailController@create', 'as' => 'purchaseorderMail.create']);
        Route::post('store', ['uses' => 'PurchaseorderMailController@store', 'as' => 'purchaseorderMail.store']);
    });

    Route::group(['prefix' => 'purchaseorder_item'], function ()
    {
        Route::post('delete', ['uses' => 'PurchaseorderItemController@delete', 'as' => 'purchaseorderItem.delete']);
    });
});
