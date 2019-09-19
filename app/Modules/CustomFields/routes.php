<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\CustomFields\Controllers')
    ->prefix('custom_fields')->name('customFields.')->group(function () {
        Route::name('index')->get('/', 'CustomFieldController@index');
        Route::name('create')->get('create', 'CustomFieldController@create');
        Route::name('edit')->get('{id}/edit', 'CustomFieldController@edit');
        Route::name('delete')->get('{id}/delete', 'CustomFieldController@delete');

        Route::name('store')->post('custom_fields', 'CustomFieldController@store');
        Route::name('update')->post('{id}', 'CustomFieldController@update');
    });
