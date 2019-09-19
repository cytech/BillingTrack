<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\TaxRates\Controllers')
    ->prefix('tax_rates')->name('taxRates.')->group(function () {
        Route::name('index')->get('/', 'TaxRateController@index');
        Route::name('create')->get('create', 'TaxRateController@create');
        Route::name('edit')->get('{taxRate}/edit', 'TaxRateController@edit');
        Route::name('delete')->get('{taxRate}/delete', 'TaxRateController@delete');

        Route::name('store')->post('tax_rates', 'TaxRateController@store');
        Route::name('update')->post('{taxRate}', 'TaxRateController@update');
    });
