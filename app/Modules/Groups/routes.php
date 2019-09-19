<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Groups\Controllers')
    ->prefix('groups')->name('groups.')->group(function () {
        Route::name('index')->get('/', 'GroupController@index');
        Route::name('create')->get('create', 'GroupController@create');
        Route::name('edit')->get('{group}/edit', 'GroupController@edit');
        Route::name('delete')->get('{group}/delete', 'GroupController@delete');

        Route::name('store')->post('groups', 'GroupController@store');
        Route::name('update')->post('{group}', 'GroupController@update');
    });
