<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware('web')->namespace('BT\Modules\API\Controllers')->prefix('api')->group(function () {
    Route::middleware('auth.admin')->group(function () {
        Route::name('api.generateKeys')->post('generate_keys', 'ApiKeyController@generateKeys');
    });
    Route::middleware('auth.api')->group(function () {
        Route::post('clients/list', 'ApiClientController@lists');
        Route::post('clients/show', 'ApiClientController@show');
        Route::post('clients/store', 'ApiClientController@store');
        Route::post('clients/update', 'ApiClientController@update');
        Route::post('clients/delete', 'ApiClientController@delete');

        Route::post('quotes/list', 'ApiQuoteController@lists');
        Route::post('quotes/show', 'ApiQuoteController@show');
        Route::post('quotes/store', 'ApiQuoteController@store');
        Route::post('quotes/items/add', 'ApiQuoteController@addItem');
        Route::post('quotes/delete', 'ApiQuoteController@delete');

        Route::post('workorders/list', 'ApiWorkorderController@lists');
        Route::post('workorders/show', 'ApiWorkorderController@show');
        Route::post('workorders/store', 'ApiWorkorderController@store');
        Route::post('workorders/items/add', 'ApiWorkorderController@addItem');
        Route::post('workorders/delete', 'ApiWorkorderController@delete');

        Route::post('invoices/list', 'ApiInvoiceController@lists');
        Route::post('invoices/show', 'ApiInvoiceController@show');
        Route::post('invoices/store', 'ApiInvoiceController@store');
        Route::post('invoices/items/add', 'ApiInvoiceController@addItem');
        Route::post('invoices/delete', 'ApiInvoiceController@delete');

        Route::post('payments/list', 'ApiPaymentController@lists');
        Route::post('payments/show', 'ApiPaymentController@show');
        Route::post('payments/store', 'ApiPaymentController@store');
        Route::post('payments/items/add', 'ApiPaymentController@addItem');
        Route::post('payments/delete', 'ApiPaymentController@delete');
    });
});
