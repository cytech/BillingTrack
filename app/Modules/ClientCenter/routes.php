<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['prefix' => 'client_center', 'middleware' => 'web', 'namespace' => 'BT\Modules\ClientCenter\Controllers'], function ()
{
    Route::get('/', ['uses' => 'ClientCenterDashboardController@redirectToLogin']);
    Route::get('invoice/{invoiceKey}', ['uses' => 'ClientCenterPublicInvoiceController@show', 'as' => 'clientCenter.public.invoice.show']);
    Route::get('invoice/{invoiceKey}/pdf', ['uses' => 'ClientCenterPublicInvoiceController@pdf', 'as' => 'clientCenter.public.invoice.pdf']);
    Route::get('invoice/{invoiceKey}/html', ['uses' => 'ClientCenterPublicInvoiceController@html', 'as' => 'clientCenter.public.invoice.html']);
    Route::get('quote/{quoteKey}', ['uses' => 'ClientCenterPublicQuoteController@show', 'as' => 'clientCenter.public.quote.show']);
    Route::get('quote/{quoteKey}/pdf', ['uses' => 'ClientCenterPublicQuoteController@pdf', 'as' => 'clientCenter.public.quote.pdf']);
    Route::get('quote/{quoteKey}/html', ['uses' => 'ClientCenterPublicQuoteController@html', 'as' => 'clientCenter.public.quote.html']);
    Route::get('quote/{quoteKey}/approve', ['uses' => 'ClientCenterPublicQuoteController@approve', 'as' => 'clientCenter.public.quote.approve']);
    Route::get('quote/{quoteKey}/reject', ['uses' => 'ClientCenterPublicQuoteController@reject', 'as' => 'clientCenter.public.quote.reject']);
    //workorders
    Route::get('workorder/{workorderKey}', ['uses' => 'ClientCenterPublicWorkorderController@show', 'as' => 'clientCenter.public.workorder.show']);
    Route::get('workorder/{workorderKey}/pdf', ['uses' => 'ClientCenterPublicWorkorderController@pdf', 'as' => 'clientCenter.public.workorder.pdf']);
    Route::get('workorder/{workorderKey}/html', ['uses' => 'ClientCenterPublicWorkorderController@html', 'as' => 'clientCenter.public.workorder.html']);
    Route::get('workorder/{workorderKey}/approve', ['uses' => 'ClientCenterPublicWorkorderController@approve', 'as' => 'clientCenter.public.workorder.approve']);
    Route::get('workorder/{workorderKey}/reject', ['uses' => 'ClientCenterPublicWorkorderController@reject', 'as' => 'clientCenter.public.workorder.reject']);

    Route::group(['middleware' => 'auth.clientCenter'], function ()
    {
        Route::get('dashboard', ['uses' => 'ClientCenterDashboardController@index', 'as' => 'clientCenter.dashboard']);
        Route::get('invoices', ['uses' => 'ClientCenterInvoiceController@index', 'as' => 'clientCenter.invoices']);
        Route::get('quotes', ['uses' => 'ClientCenterQuoteController@index', 'as' => 'clientCenter.quotes']);
        Route::get('workorders', ['uses' => 'ClientCenterWorkorderController@index', 'as' => 'clientCenter.workorders']);
        Route::get('payments', ['uses' => 'ClientCenterPaymentController@index', 'as' => 'clientCenter.payments']);
    });
});
