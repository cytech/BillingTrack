<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware('web')->namespace('BT\Modules\Setup\Controllers')
    ->prefix('setup')->name('setup.')->group(function () {
        Route::name('index')->get('/', 'SetupController@index');
        Route::name('postIndex')->post('/', 'SetupController@postIndex');

        Route::name('prerequisites')->get('prerequisites', 'SetupController@prerequisites');

        Route::name('migration')->get('migration', 'SetupController@migration');
        Route::name('postMigration')->post('migration', 'SetupController@postMigration');

        Route::name('account')->get('account', 'SetupController@account');
        Route::name('postAccount')->post('account', 'SetupController@postAccount');

        Route::name('complete')->get('complete', 'SetupController@complete');
    });
