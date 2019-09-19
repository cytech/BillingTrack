<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Users\Controllers')
    ->prefix('users')->name('users.')->group(function () {
        Route::name('index')->get('/', 'UserController@index');

        Route::name('create')->get('create/{userType}', 'UserController@create');
        Route::name('store')->post('create/{userType}', 'UserController@store');

        Route::name('edit')->get('{id}/edit/{userType}', 'UserController@edit');
        Route::name('update')->post('{id}/edit/{userType}', 'UserController@update');

        Route::name('delete')->get('{id}/delete', 'UserController@delete');

        Route::name('password.edit')->get('{id}/password/edit', 'UserPasswordController@edit');
        Route::name('password.update')->post('{id}/password/edit', 'UserPasswordController@update');

        Route::name('clientInfo')->post('client', 'UserController@getClientInfo');

    });
