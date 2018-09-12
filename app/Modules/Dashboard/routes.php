<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin'], 'namespace' => 'FI\Modules\Dashboard\Controllers'], function ()
{
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);
    //clear views from storage
    Route::get('/viewclear', [function () {
        Artisan::call('view:clear');
        return redirect()->route('dashboard.index');
    }]);
});