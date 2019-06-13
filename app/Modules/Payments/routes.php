<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'BT\Modules\Payments\Controllers'], function ()
{
    Route::get('payments', ['uses' => 'PaymentController@index', 'as' => 'payments.index']);
    Route::post('payments/create', ['uses' => 'PaymentController@create', 'as' => 'payments.create']);
    Route::post('payments/store', ['uses' => 'PaymentController@store', 'as' => 'payments.store']);
    Route::get('payments/{payment}', ['uses' => 'PaymentController@edit', 'as' => 'payments.edit']);
    Route::post('payments/{payment}', ['uses' => 'PaymentController@update', 'as' => 'payments.update']);

    Route::get('test', ['uses' => 'PaymentController@test', 'as' => 'payments.test']);

    Route::get('payments/{payment}/delete', ['uses' => 'PaymentController@delete', 'as' => 'payments.delete']);

    Route::post('bulk/delete', ['uses' => 'PaymentController@bulkDelete', 'as' => 'payments.bulk.delete']);

    Route::group(['prefix' => 'payment_mail'], function ()
    {
        Route::post('create', ['uses' => 'PaymentMailController@create', 'as' => 'paymentMail.create']);
        Route::post('store', ['uses' => 'PaymentMailController@store', 'as' => 'paymentMail.store']);
    });
});
