<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Products\Controllers')
    ->prefix('products')->name('products.')->group(function () {
    Route::name('index')->get('/', 'ProductController@index');
    Route::name('edit')->get('{id}/edit', 'ProductController@edit');
    Route::name('update')->put('{id}/edit', 'ProductController@update');
    Route::name('create')->get('create', 'ProductController@create');
    Route::name('store')->post('create', 'ProductController@store');

    Route::name('ajax.getProduct')->get('products/ajax/get_product/{vendorId}', 'ProductController@getProduct');
    Route::name('ajax.processProduct')->post('products/ajax/process_product', 'ProductController@processProduct');
    Route::name('ajax.product')->get('products/ajax/product', 'ProductController@ajaxProduct');

});
