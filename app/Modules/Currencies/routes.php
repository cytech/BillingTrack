<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Currencies\Controllers')
    ->prefix('currencies')->name('currencies.')->group(function () {
        Route::name('index')->get('/', 'CurrencyController@index');
        Route::name('create')->get('create', 'CurrencyController@create');
        Route::name('edit')->get('{id}/edit', 'CurrencyController@edit');
        Route::name('delete')->get('{id}/delete', 'CurrencyController@delete');

        Route::name('store')->post('currencies', 'CurrencyController@store');
        Route::name('getExchangeRate')->post('get-exchange-rate', 'CurrencyController@getExchangeRate');
        Route::name('update')->post('{id}', 'CurrencyController@update');

    });
