<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'BT\Modules\Vendors\Controllers'], function () {
//		//vendors
//	    Route::group(['prefix' => 'vendors'], function () {
//		    Route::get('/', ['uses' => 'VendorController@index', 'as' => 'vendors.index']);
//            Route::get('{id}', ['uses' => 'VendorController@show', 'as' => 'vendors.show']);
//            Route::get('{id}/edit', ['uses' => 'VendorController@edit', 'as' => 'vendors.edit']);
//		    Route::put('{id}/edit', ['uses' => 'VendorController@update', 'as' => 'vendors.update']);
//		    Route::get('create', ['uses' => 'VendorController@create', 'as' => 'vendors.create']);
//		    Route::post('create', ['uses' => 'VendorController@store', 'as' => 'vendors.store']);
//	    });
//});


/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'prefix' => 'vendors', 'namespace' => 'BT\Modules\Vendors\Controllers'], function () {
    Route::get('/', ['uses' => 'VendorController@index', 'as' => 'vendors.index']);
    Route::get('create', ['uses' => 'VendorController@create', 'as' => 'vendors.create']);
    Route::get('{id}/edit', ['uses' => 'VendorController@edit', 'as' => 'vendors.edit']);
    Route::get('{id}', ['uses' => 'VendorController@show', 'as' => 'vendors.show']);
    Route::get('{id}/delete', ['uses' => 'VendorController@delete', 'as' => 'vendors.delete']);
    Route::get('ajax/lookup', ['uses' => 'VendorController@ajaxLookup', 'as' => 'vendors.ajax.lookup']);

    Route::post('create', ['uses' => 'VendorController@store', 'as' => 'vendors.store']);
    Route::post('ajax/modal_edit', ['uses' => 'VendorController@ajaxModalEdit', 'as' => 'vendors.ajax.modalEdit']);
    Route::post('ajax/modal_lookup', ['uses' => 'VendorController@ajaxModalLookup', 'as' => 'vendors.ajax.modalLookup']);
    Route::post('ajax/modal_update/{id}', ['uses' => 'VendorController@ajaxModalUpdate', 'as' => 'vendors.ajax.modalUpdate']);
    Route::post('ajax/check_name', ['uses' => 'VendorController@ajaxCheckName', 'as' => 'vendors.ajax.checkName']);
    Route::post('ajax/check_duplicate_name', ['uses' => 'VendorController@ajaxCheckDuplicateName', 'as' => 'vendors.ajax.checkDuplicateName']);
    Route::post('{id}/edit', ['uses' => 'VendorController@update', 'as' => 'vendors.update']);

    Route::post('bulk/delete', ['uses' => 'VendorController@bulkDelete', 'as' => 'vendors.bulk.delete']);

    Route::group(['prefix' => '{vendorId}/contacts'], function () {
        Route::get('create', ['uses' => 'ContactController@create', 'as' => 'vendors.contacts.create']);
        Route::post('create', ['uses' => 'ContactController@store', 'as' => 'vendors.contacts.store']);
        Route::get('edit/{contactId}', ['uses' => 'ContactController@edit', 'as' => 'vendors.contacts.edit']);
        Route::post('edit/{contactId}', ['uses' => 'ContactController@update', 'as' => 'vendors.contacts.update']);
        Route::post('delete', ['uses' => 'ContactController@delete', 'as' => 'vendors.contacts.delete']);
        Route::post('default', ['uses' => 'ContactController@updateDefault', 'as' => 'vendors.contacts.updateDefault']);
    });
});

