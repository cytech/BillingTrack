<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Products\Controllers'], function () {
		//products
	    Route::group(['prefix' => 'products'], function () {
		    Route::get('/', ['uses' => 'ProductController@index', 'as' => 'products.index']);
		    Route::get('{id}/edit', ['uses' => 'ProductController@edit', 'as' => 'products.edit']);
		    Route::put('{id}/edit', ['uses' => 'ProductController@update', 'as' => 'products.update']);
		    Route::get('create', ['uses' => 'ProductController@create', 'as' => 'products.create']);
		    Route::post('create', ['uses' => 'ProductController@store', 'as' => 'products.store']);
	    });
});