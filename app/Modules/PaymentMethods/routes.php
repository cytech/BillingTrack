<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\PaymentMethods\Controllers')
    ->prefix('payment_methods')->name('paymentMethods.')->group(function () {
        Route::name('index')->get('/', 'PaymentMethodController@index');
        Route::name('create')->get('create', 'PaymentMethodController@create');
        Route::name('edit')->get('{paymentMethod}/edit', 'PaymentMethodController@edit');
        Route::name('delete')->get('{paymentMethod}/delete', 'PaymentMethodController@delete');

        Route::name('store')->post('payment_methods', 'PaymentMethodController@store');
        Route::name('update')->post('{paymentMethod}', 'PaymentMethodController@update');
    });
