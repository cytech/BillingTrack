<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => 'web', 'namespace' => 'FI\Modules\Setup\Controllers'], function ()
{
    Route::get('setup', ['uses' => 'SetupController@index', 'as' => 'setup.index']);
    Route::post('setup', ['uses' => 'SetupController@postIndex', 'as' => 'setup.postIndex']);

    Route::get('setup/prerequisites', ['uses' => 'SetupController@prerequisites', 'as' => 'setup.prerequisites']);

    Route::get('setup/migration', ['uses' => 'SetupController@migration', 'as' => 'setup.migration']);
    Route::post('setup/migration', ['uses' => 'SetupController@postMigration', 'as' => 'setup.postMigration']);

    Route::get('setup/neworxfer', ['uses' => 'SetupController@neworxfer', 'as' => 'setup.neworxfer']);

    Route::get('setup/xferaccount', ['uses' => 'SetupController@xferaccount', 'as' => 'setup.xferaccount']);
    Route::post('setup/xferaccount', ['uses' => 'SetupController@postXferAccount', 'as' => 'setup.postXferAccount']);


    Route::get('setup/newaccount', ['uses' => 'SetupController@account', 'as' => 'setup.newaccount']);
    Route::post('setup/newaccount', ['uses' => 'SetupController@postAccount', 'as' => 'setup.postNewAccount']);

    Route::get('setup/complete', ['uses' => 'SetupController@complete', 'as' => 'setup.complete']);
});
