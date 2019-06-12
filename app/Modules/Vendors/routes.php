<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Vendors\Controllers'], function () {
		//vendors
	    Route::group(['prefix' => 'vendors'], function () {
		    Route::get('/', ['uses' => 'VendorController@index', 'as' => 'vendors.index']);
		    Route::get('{id}/edit', ['uses' => 'VendorController@edit', 'as' => 'vendors.edit']);
		    Route::put('{id}/edit', ['uses' => 'VendorController@update', 'as' => 'vendors.update']);
		    Route::get('create', ['uses' => 'VendorController@create', 'as' => 'vendors.create']);
		    Route::post('create', ['uses' => 'VendorController@store', 'as' => 'vendors.store']);
	    });
});
