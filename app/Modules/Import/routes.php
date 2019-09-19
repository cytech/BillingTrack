<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Import\Controllers')
    ->prefix('import')->name('import.')->group(function () {
        Route::name('index')->get('/', 'ImportController@index');
        Route::name('map')->get('map/{import_type}', 'ImportController@mapImport');

        Route::name('upload')->post('upload', 'ImportController@upload');
        Route::name('map.submit')->post('map/{import_type}', 'ImportController@mapImportSubmit');
    });
