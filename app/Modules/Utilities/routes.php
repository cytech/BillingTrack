<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Utilities\Controllers'], function ()
{
    Route::get('utilities/manage_trash', ['uses' => 'UtilityController@manageTrash', 'as' => 'utilities.manage_trash']);
    Route::get('utilities/{id}/restore_trash/{entity}', ['uses' => 'UtilityController@restoreTrash', 'as' => 'utilities.restore_trash']);
    Route::get('utilities/{id}/delete_trash/{entity}', ['uses' => 'UtilityController@deleteTrash', 'as' => 'utilities.delete_trash']);
    Route::post('utilities/bulk/delete_trash', ['uses' => 'UtilityController@bulkDeleteTrash', 'as' => 'utilities.bulk.deletetrash']);
    Route::post('utilities/bulk/restore_trash', ['uses' => 'UtilityController@bulkRestoreTrash', 'as' => 'utilities.bulk.restoretrash']);

    //batchprint pdf
    Route::any('batchprint', ['uses' => 'UtilityController@batchPrint', 'as' => 'utilities.batchprint']);

});