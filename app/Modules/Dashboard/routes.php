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
    Route::get('/documentation', ['uses' => 'DashboardController@documentation','as' => 'dashboard.documentation']);
});