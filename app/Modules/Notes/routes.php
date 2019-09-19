<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth'])->namespace('BT\Modules\Notes\Controllers')
    ->prefix('notes')->name('notes.')->group(function () {
        Route::name('create')->post('create', 'NoteController@create');
        Route::name('delete')->post('delete', 'NoteController@delete');
    });
