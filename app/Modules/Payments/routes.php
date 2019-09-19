<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Payments\Controllers')
    ->prefix('payments')->name('payments.')->group(function ()
{
    Route::name('index')->get('/', 'PaymentController@index');
    Route::name('create')->post('create', 'PaymentController@create');
    Route::name('store')->post('store', 'PaymentController@store');
    Route::name('edit')->get('{payment}', 'PaymentController@edit');
    Route::name('update')->post('{payment}', 'PaymentController@update');
    Route::name('delete')->get('{payment}/delete', 'PaymentController@delete');
    Route::name('bulk.delete')->post('bulk/delete', 'PaymentController@bulkDelete');

    Route::prefix('payment_mail')->group(function ()
    {
        Route::name('paymentMail.create')->post('create', 'PaymentMailController@create');
        Route::name('paymentMail.store')->post('store', 'PaymentMailController@store');
    });

    Route::name('test')->get('test', 'PaymentController@test');

});
