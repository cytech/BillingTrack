<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Routes note laravel undocumented  https://github.com/laravel/framework/issues/19020
 * when loading custom routes in AppServiceProvider, the name() method in the loaded routes.php
 * has to be first or it does not get initialized with the route properly
 * WORKS
 *         Route::name('index')->get('/', 'CategoriesController@index');
 * DOES NOT WORK
 *         Route::get('/', 'CategoriesController@index')->name('index');
*/

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Categories\Controllers')
    ->prefix('categories')->name('categories.')->group(function () {
        Route::name('index')->get('/', 'CategoriesController@index');
        Route::name('edit')->get('{id}/edit', 'CategoriesController@edit');
        Route::name('update')->put('{id}/edit', 'CategoriesController@update');
        Route::name('create')->get('create', 'CategoriesController@create');
        Route::name('store')->post('create', 'CategoriesController@store');
    });
