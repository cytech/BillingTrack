<?php

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Expenses\Controllers')
    ->prefix('expenses')->name('expenses.')->group(function () {
        Route::name('index')->get('/', 'ExpenseController@index');
        Route::name('create')->get('create', 'ExpenseCreateController@create');
        Route::name('store')->post('create', 'ExpenseCreateController@store');
        Route::name('edit')->get('{id}/edit', 'ExpenseEditController@edit');
        Route::name('update')->post('{id}/edit', 'ExpenseEditController@update');
        Route::name('delete')->get('{id}/delete', 'ExpenseController@delete');

        Route::prefix('bill')->name('expenseBill.')->group(function () {
            Route::name('create')->post('create', 'ExpenseBillController@create');
            Route::name('store')->post('store', 'ExpenseBillController@store');
        });

        Route::name('lookupCategory')->get('lookup/category', 'ExpenseLookupController@lookupCategory');
        Route::name('lookupVendor')->get('lookup/vendor', 'ExpenseLookupController@lookupVendor');

        Route::name('bulk.delete')->post('bulk/delete', 'ExpenseController@bulkDelete');
    });
