<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Settings\Controllers')
    ->prefix('settings')->name('settings.')->group(function () {
        Route::name('index')->get('/', 'SettingController@index');
        Route::name('update')->post('/', 'SettingController@update');
        Route::name('updateCheck')->get('update_check', 'SettingController@updateCheck');
        Route::name('logo.delete')->get('logo/delete', 'SettingController@logoDelete');
        Route::name('saveTab')->post('save_tab', 'SettingController@saveTab');
    });
