<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->group(function () {
    Route::get('documentation/{page}', [function ($page) {
        return view('documentation.linkview')->with('page', 'documentation.' . basename($page, '.md'));
    }]);
});
