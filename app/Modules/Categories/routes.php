<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Categories\Controllers'], function () {
		//categories
	    Route::group(['prefix' => 'categories'], function () {
		    Route::get('/', ['uses' => 'CategoriesController@index', 'as' => 'categories.index']);
		    Route::get('{id}/edit', ['uses' => 'CategoriesController@edit', 'as' => 'categories.edit']);
		    Route::put('{id}/edit', ['uses' => 'CategoriesController@update', 'as' => 'categories.update']);
		    Route::get('create', ['uses' => 'CategoriesController@create', 'as' => 'categories.create']);
		    Route::post('create', ['uses' => 'CategoriesController@store', 'as' => 'categories.store']);
	    });
});
