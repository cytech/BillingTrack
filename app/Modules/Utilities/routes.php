<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Utilities\Controllers')
    ->prefix('utilities')->name('utilities.')->group(function () {
        Route::name('manage_trash')->get('manage_trash', 'UtilityController@manageTrash');
        Route::name('restore_trash')->get('{id}/restore_trash/{entity}', 'UtilityController@restoreTrash');
        Route::name('delete_trash')->get('{id}/delete_trash/{entity}', 'UtilityController@deleteTrash');
        Route::name('bulk.deletetrash')->post('bulk/delete_trash', 'UtilityController@bulkDeleteTrash');
        Route::name('bulk.restoretrash')->post('bulk/restore_trash', 'UtilityController@bulkRestoreTrash');
        Route::name('saveTab')->post('save_tab', 'UtilityController@saveTab');

        //batchprint pdf
        Route::name('batchprint')->any('batchprint', 'UtilityController@batchPrint');

        if (!config('app.demo')) {
            Route::name('database')->get('database', 'BackupController@index');
            Route::name('backup.database')->get('backup/database', 'BackupController@database');
            Route::name('trashprior.database')->get('trashprior/database', 'BackupController@trashPrior');
            Route::name('deleteprior.database')->get('deleteprior/database', 'BackupController@deletePrior');
            Route::name('clientprior.database')->get('clientprior/database', 'BackupController@clientInactivePrior');
        }

    });
