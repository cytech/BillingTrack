<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => ['web', 'auth.admin']], function ()
{
    Route::get('documentation/{page}', [function ( $page) {
        return view('documentation.' .  $page);
        }]);

});
