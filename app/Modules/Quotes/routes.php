<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Quotes\Controllers')->group(function () {
    Route::prefix('quotes')->name('quotes.')->group(function () {
        Route::name('index')->get('/', 'QuoteController@index');
        Route::name('create')->get('create', 'QuoteCreateController@create');
        Route::name('store')->post('create', 'QuoteCreateController@store');
        Route::name('edit')->get('{id}/edit', 'QuoteEditController@edit');
        Route::name('update')->post('{id}/edit', 'QuoteEditController@update');
        Route::name('delete')->get('{id}/delete', 'QuoteController@delete');
        Route::name('pdf')->get('{id}/pdf', 'QuoteController@pdf');

        Route::name('quoteEdit.refreshEdit')->get('{id}/edit/refresh', 'QuoteEditController@refreshEdit');
        Route::name('quoteEdit.refreshTo')->post('edit/refresh_to', 'QuoteEditController@refreshTo');
        Route::name('quoteEdit.refreshFrom')->post('edit/refresh_from', 'QuoteEditController@refreshFrom');
        Route::name('quoteEdit.refreshTotals')->post('edit/refresh_totals', 'QuoteEditController@refreshTotals');
        Route::name('quoteEdit.updateClient')->post('edit/update_client', 'QuoteEditController@updateClient');
        Route::name('quoteEdit.updateCompanyProfile')->post('edit/update_company_profile', 'QuoteEditController@updateCompanyProfile');
        Route::name('recalculate')->post('recalculate', 'QuoteRecalculateController@recalculate');
        Route::name('bulk.delete')->post('bulk/delete', 'QuoteController@bulkDelete');
        Route::name('bulk.status')->post('bulk/status', 'QuoteController@bulkStatus');
    });

    Route::prefix('quote_copy')->name('quoteCopy.')->group(function () {
        Route::name('create')->post('create', 'QuoteCopyController@create');
        Route::name('store')->post('store', 'QuoteCopyController@store');
    });

    Route::prefix('quote_to_invoice')->name('quoteToInvoice.')->group(function () {
        Route::name('create')->post('create', 'QuoteToInvoiceController@create');
        Route::name('store')->post('store', 'QuoteToInvoiceController@store');
    });

    Route::prefix('quote_to_workorder')->name('quoteToWorkorder.')->group(function () {
        Route::name('create')->post('create', 'QuoteToWorkorderController@create');
        Route::name('store')->post('store', 'QuoteToWorkorderController@store');
    });

    Route::prefix('quote_mail')->name('quoteMail.')->group(function () {
        Route::name('create')->post('create', 'QuoteMailController@create');
        Route::name('store')->post('store', 'QuoteMailController@store');
    });

    Route::prefix('quote_item')->name('quoteItem.')->group(function () {
        Route::name('delete')->post('delete', 'QuoteItemController@delete');
    });
});
