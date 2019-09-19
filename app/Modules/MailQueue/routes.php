<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\MailQueue\Controllers')
    ->prefix('mail_log')->name('mailLog.')->group(function () {
        Route::name('index')->get('/', 'MailLogController@index');
        Route::name('content')->post('content', 'MailLogController@content');
        Route::name('delete')->get('{id}/delete', 'MailLogController@delete');
    });
