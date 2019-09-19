<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Clients\Controllers')
    ->prefix('clients')->name('clients.')->group(function () {
        Route::name('index')->get('/', 'ClientController@index');
        Route::name('create')->get('create', 'ClientController@create');
        Route::name('edit')->get('{id}/edit', 'ClientController@edit');
        Route::name('show')->get('{id}', 'ClientController@show');
        Route::name('delete')->get('{id}/delete', 'ClientController@delete');
        Route::name('ajax.lookup')->get('ajax/lookup', 'ClientController@ajaxLookup');

        Route::name('store')->post('create', 'ClientController@store');
        Route::name('ajax.modalEdit')->post('ajax/modal_edit', 'ClientController@ajaxModalEdit');
        Route::name('ajax.modalLookup')->post('ajax/modal_lookup', 'ClientController@ajaxModalLookup');
        Route::name('ajax.modalUpdate')->post('ajax/modal_update/{id}', 'ClientController@ajaxModalUpdate');
        Route::name('ajax.checkName')->post('ajax/check_name', 'ClientController@ajaxCheckName');
        Route::name('ajax.checkDuplicateName')->post('ajax/check_duplicate_name', 'ClientController@ajaxCheckDuplicateName');
        Route::name('update')->post('{id}/edit', 'ClientController@update');

        Route::name('bulk.delete')->post('bulk/delete', 'ClientController@bulkDelete');

        Route::group(['prefix' => '{clientId}/contacts'], function () {
            Route::name('contacts.create')->get('create', 'ContactController@create');
            Route::name('contacts.store')->post('create', 'ContactController@store');
            Route::name('contacts.edit')->get('edit/{contactId}', 'ContactController@edit');
            Route::name('contacts.update')->post('edit/{contactId}', 'ContactController@update');
            Route::name('contacts.delete')->post('delete', 'ContactController@delete');
            Route::name('contacts.updateDefault')->post('default', 'ContactController@updateDefault');
        });
    });
