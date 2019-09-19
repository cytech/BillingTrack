<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\RecurringInvoices\Controllers')->group(function () {
    Route::prefix('recurring_invoices')->name('recurringInvoices.')->group(function () {
        Route::name('index')->get('/', 'RecurringInvoiceController@index');
        Route::name('create')->get('create', 'RecurringInvoiceCreateController@create');
        Route::name('store')->post('create', 'RecurringInvoiceCreateController@store');
        Route::name('edit')->get('{id}/edit', 'RecurringInvoiceEditController@edit');
        Route::name('update')->post('{id}/edit', 'RecurringInvoiceEditController@update');
        Route::name('delete')->get('{id}/delete', 'RecurringInvoiceController@delete');

        Route::name('recurringInvoiceEdit.refreshEdit')->get('{id}/edit/refresh', 'RecurringInvoiceEditController@refreshEdit');
        Route::name('recurringInvoiceEdit.refreshTo')->post('edit/refresh_to', 'RecurringInvoiceEditController@refreshTo');
        Route::name('recurringInvoiceEdit.refreshFrom')->post('edit/refresh_from', 'RecurringInvoiceEditController@refreshFrom');
        Route::name('recurringInvoiceEdit.refreshTotals')->post('edit/refresh_totals', 'RecurringInvoiceEditController@refreshTotals');
        Route::name('recurringInvoiceEdit.updateClient')->post('edit/update_client', 'RecurringInvoiceEditController@updateClient');
        Route::name('recurringInvoiceEdit.updateCompanyProfile')->post('edit/update_company_profile', 'RecurringInvoiceEditController@updateCompanyProfile');
        Route::name('recalculate')->post('recalculate', 'RecurringInvoiceRecalculateController@recalculate');
        Route::name('bulk.delete')->post('bulk/delete', 'RecurringInvoiceController@bulkDelete');
    });

    Route::prefix('recurring_invoice_copy')->name('recurringInvoiceCopy.')->group(function () {
        Route::name('create')->post('create', 'RecurringInvoiceCopyController@create');
        Route::name('store')->post('store', 'RecurringInvoiceCopyController@store');
    });

    Route::prefix('recurring_invoice_item')->name('recurringInvoiceItem.')->group(function () {
        Route::name('delete')->post('delete', 'RecurringInvoiceItemController@delete');
    });
});
