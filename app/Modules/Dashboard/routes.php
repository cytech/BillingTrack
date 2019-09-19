<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Dashboard\Controllers')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::name('dashboard.index')->get('dashboard', 'DashboardController@index');
    //clear views from storage
    Route::get('/viewclear', [function () {
        Artisan::call('view:clear');
        return redirect()->route('dashboard.index');
    }]);
});
