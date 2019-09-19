<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Addons\Controllers')
    ->prefix('addons')->name('addons.')->group(function () {
        Route::name('index')->get('/', 'AddonController@index');
        Route::name('install')->get('install/{id}', 'AddonController@install');
        Route::name('uninstall')->get('uninstall/{id}', 'AddonController@uninstall');
        Route::name('upgrade')->get('upgrade/{id}', 'AddonController@upgrade');
    });
