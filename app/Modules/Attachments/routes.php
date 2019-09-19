<?php

Route::middleware('web')->namespace('BT\Modules\Attachments\Controllers')->prefix('attachments')
    ->name('attachments.')->group(function () {
        Route::name('download')->get('{urlKey}/download', 'AttachmentController@download');

        Route::middleware('auth.admin')->group(function () {
            Route::name('ajax.list')->post('ajax/list', 'AttachmentController@ajaxList');
            Route::name('ajax.delete')->post('ajax/delete', 'AttachmentController@ajaxDelete');
            Route::name('ajax.modal')->post('ajax/modal', 'AttachmentController@ajaxModal');
            Route::name('ajax.upload')->post('ajax/upload', 'AttachmentController@ajaxUpload');
            Route::name('ajax.access.update')->post('ajax/access/update', 'AttachmentController@ajaxAccessUpdate');
        });
    });
