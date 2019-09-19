<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Vendors\Controllers')
    ->prefix('vendors')->name('vendors.')->group(function () {
        Route::name('index')->get('/', 'VendorController@index');
        Route::name('create')->get('create', 'VendorController@create');
        Route::name('edit')->get('{id}/edit', 'VendorController@edit');
        Route::name('show')->get('{id}', 'VendorController@show');
        Route::name('delete')->get('{id}/delete', 'VendorController@delete');
        Route::name('ajax.lookup')->get('ajax/lookup', 'VendorController@ajaxLookup');

        Route::name('store')->post('create', 'VendorController@store');
        Route::name('ajax.modalEdit')->post('ajax/modal_edit', 'VendorController@ajaxModalEdit');
        Route::name('ajax.modalLookup')->post('ajax/modal_lookup', 'VendorController@ajaxModalLookup');
        Route::name('ajax.modalUpdate')->post('ajax/modal_update/{id}', 'VendorController@ajaxModalUpdate');
        Route::name('ajax.checkName')->post('ajax/check_name', 'VendorController@ajaxCheckName');
        Route::name('ajax.checkDuplicateName')->post('ajax/check_duplicate_name', 'VendorController@ajaxCheckDuplicateName');
        Route::name('update')->post('{id}/edit', 'VendorController@update');

        Route::name('bulk.delete')->post('bulk/delete', 'VendorController@bulkDelete');

        Route::prefix('{vendorId}/contacts')->group(function () {
            Route::name('contacts.create')->get('create', 'ContactController@create');
            Route::name('contacts.store')->post('create', 'ContactController@store');
            Route::name('contacts.edit')->get('edit/{contactId}', 'ContactController@edit');
            Route::name('contacts.update')->post('edit/{contactId}', 'ContactController@update');
            Route::name('contacts.delete')->post('delete', 'ContactController@delete');
            Route::name('contacts.updateDefault')->post('default', 'ContactController@updateDefault');
        });
    });

