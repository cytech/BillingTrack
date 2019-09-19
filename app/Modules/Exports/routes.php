<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Exports\Controllers')
    ->prefix('export')->name('export.')->group(function () {
        Route::name('index')->get('/', 'ExportController@index');
        Route::name('export')->post('{export}', 'ExportController@export');
    });
