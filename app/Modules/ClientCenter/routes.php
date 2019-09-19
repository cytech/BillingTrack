<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware('web')->namespace('BT\Modules\ClientCenter\Controllers')
    ->prefix('client_center')->name('clientCenter.')->group(function () {
        Route::get('/', 'ClientCenterDashboardController@redirectToLogin');
        Route::name('public.invoice.show')->get('invoice/{invoiceKey}', 'ClientCenterPublicInvoiceController@show');
        Route::name('public.invoice.pdf')->get('invoice/{invoiceKey}/pdf', 'ClientCenterPublicInvoiceController@pdf');
        Route::name('public.invoice.html')->get('invoice/{invoiceKey}/html', 'ClientCenterPublicInvoiceController@html');
        Route::name('public.quote.show')->get('quote/{quoteKey}', 'ClientCenterPublicQuoteController@show');
        Route::name('public.quote.pdf')->get('quote/{quoteKey}/pdf', 'ClientCenterPublicQuoteController@pdf');
        Route::name('public.quote.html')->get('quote/{quoteKey}/html', 'ClientCenterPublicQuoteController@html');
        Route::name('public.quote.approve')->get('quote/{quoteKey}/approve', 'ClientCenterPublicQuoteController@approve');
        Route::name('public.quote.reject')->get('quote/{quoteKey}/reject', 'ClientCenterPublicQuoteController@reject');
        Route::name('public.workorder.show')->get('workorder/{workorderKey}', 'ClientCenterPublicWorkorderController@show');
        Route::name('public.workorder.pdf')->get('workorder/{workorderKey}/pdf', 'ClientCenterPublicWorkorderController@pdf');
        Route::name('public.workorder.html')->get('workorder/{workorderKey}/html', 'ClientCenterPublicWorkorderController@html');
        Route::name('public.workorder.approve')->get('workorder/{workorderKey}/approve', 'ClientCenterPublicWorkorderController@approve');
        Route::name('public.workorder.reject')->get('workorder/{workorderKey}/reject', 'ClientCenterPublicWorkorderController@reject');
        Route::middleware('auth.clientCenter')->group(function () {
            Route::name('dashboard')->get('dashboard', 'ClientCenterDashboardController@index');
            Route::name('invoices')->get('invoices', 'ClientCenterInvoiceController@index');
            Route::name('quotes')->get('quotes', 'ClientCenterQuoteController@index');
            Route::name('workorders')->get('workorders', 'ClientCenterWorkorderController@index');
            Route::name('payments')->get('payments', 'ClientCenterPaymentController@index');
        });
    });
