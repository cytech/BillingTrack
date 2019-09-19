<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware('web')->namespace('BT\Modules\Sessions\Controllers')->group(function () {
    Route::name('session.login')->get('login', 'SessionController@login');
    Route::name('session.attempt')->post('login', 'SessionController@attempt');
    Route::name('session.logout')->get('logout', 'SessionController@logout');
});
