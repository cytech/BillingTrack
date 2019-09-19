<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Invoices\Controllers')->group(function () {
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::name('index')->get('/', 'InvoiceController@index');
        Route::name('create')->get('create', 'InvoiceCreateController@create');
        Route::name('store')->post('create', 'InvoiceCreateController@store');
        Route::name('edit')->get('{id}/edit', 'InvoiceEditController@edit');
        Route::name('update')->post('{id}/edit', 'InvoiceEditController@update');
        Route::name('delete')->get('{id}/delete', 'InvoiceController@delete');
        Route::name('pdf')->get('{id}/pdf', 'InvoiceController@pdf');
        Route::name('ajaxLookup')->get('ajaxLookup/{name}', 'InvoiceController@ajaxLookup');

        Route::name('invoiceEdit.refreshEdit')->get('{id}/edit/refresh', 'InvoiceEditController@refreshEdit');
        Route::name('invoiceEdit.refreshTo')->post('edit/refresh_to', 'InvoiceEditController@refreshTo');
        Route::name('invoiceEdit.refreshFrom')->post('edit/refresh_from', 'InvoiceEditController@refreshFrom');
        Route::name('invoiceEdit.refreshTotals')->post('edit/refresh_totals', 'InvoiceEditController@refreshTotals');
        Route::name('invoiceEdit.updateClient')->post('edit/update_client', 'InvoiceEditController@updateClient');
        Route::name('invoiceEdit.updateCompanyProfile')->post('edit/update_company_profile', 'InvoiceEditController@updateCompanyProfile');
        Route::name('recalculate')->post('recalculate', 'InvoiceRecalculateController@recalculate');
        Route::name('bulk.delete')->post('bulk/delete', 'InvoiceController@bulkDelete');
        Route::name('bulk.status')->post('bulk/status', 'InvoiceController@bulkStatus');
    });

    Route::prefix('invoice_copy')->name('invoiceCopy.')->group(function () {
        Route::name('create')->post('create', 'InvoiceCopyController@create');
        Route::name('store')->post('store', 'InvoiceCopyController@store');
    });

    Route::prefix('invoice_mail')->name('invoiceMail.')->group(function () {
        Route::name('create')->post('create', 'InvoiceMailController@create');
        Route::name('store')->post('store', 'InvoiceMailController@store');
    });

    Route::prefix('invoice_item')->name('invoiceItem.')->group(function () {
        Route::name('delete')->post('delete', 'InvoiceItemController@delete');
    });
});
