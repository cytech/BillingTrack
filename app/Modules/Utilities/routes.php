<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'BT\Modules\Utilities\Controllers'], function ()
{
    Route::get('utilities/manage_trash', ['uses' => 'UtilityController@manageTrash', 'as' => 'utilities.manage_trash']);
    Route::get('utilities/{id}/restore_trash/{entity}', ['uses' => 'UtilityController@restoreTrash', 'as' => 'utilities.restore_trash']);
    Route::get('utilities/{id}/delete_trash/{entity}', ['uses' => 'UtilityController@deleteTrash', 'as' => 'utilities.delete_trash']);
    Route::post('utilities/bulk/delete_trash', ['uses' => 'UtilityController@bulkDeleteTrash', 'as' => 'utilities.bulk.deletetrash']);
    Route::post('utilities/bulk/restore_trash', ['uses' => 'UtilityController@bulkRestoreTrash', 'as' => 'utilities.bulk.restoretrash']);
    Route::post('utilities/save_tab', ['uses' => 'UtilityController@saveTab', 'as' => 'utilities.saveTab']);

    //batchprint pdf
    Route::any('batchprint', ['uses' => 'UtilityController@batchPrint', 'as' => 'utilities.batchprint']);

    if (!config('app.demo'))
    {
        Route::get('utilities/database', ['uses' => 'BackupController@index', 'as' => 'utilities.database']);
        Route::get('backup/database', ['uses' => 'BackupController@database', 'as' => 'backup.database']);
        Route::get('trashprior/database', ['uses' => 'BackupController@trashPrior', 'as' => 'trashprior.database']);
        Route::get('deleteprior/database', ['uses' => 'BackupController@deletePrior', 'as' => 'deleteprior.database']);
    }

});
