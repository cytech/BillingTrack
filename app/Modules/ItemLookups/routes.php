<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\ItemLookups\Controllers')
    ->prefix('item_lookups')->name('itemLookups.')->group(function () {
        Route::name('index')->get('/', 'ItemLookupController@index');
        Route::name('create')->get('create', 'ItemLookupController@create');
        Route::name('edit')->get('{itemLookup}/edit', 'ItemLookupController@edit');
        Route::name('delete')->get('{itemLookup}/delete', 'ItemLookupController@delete');
        Route::name('ajax.getItemLookup')->get('ajax/get_item_lookup', 'ItemLookupController@getItemLookup');
        Route::name('ajax.processItemLookup')->post('ajax/process_item_lookup', 'ItemLookupController@processItemLookup');
        Route::name('ajax.itemLookup')->get('ajax/item_lookup', 'ItemLookupController@ajaxItemLookup');

        Route::name('store')->post('item_lookups', 'ItemLookupController@store');
        Route::name('update')->post('{itemLookup}', 'ItemLookupController@update');
        Route::name('ajax.process')->post('ajax/process', 'ItemLookupController@process');
    });
