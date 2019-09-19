<?php

Route::middleware('web')->namespace('BT\Modules\Merchant\Controllers')
    ->prefix('merchant')->name('merchant.')->group(function () {
        Route::name('pay')->post('pay', 'MerchantController@pay');
        Route::name('cancelUrl')->get('{driver}/{urlKey}/cancel', 'MerchantController@cancelUrl');
        Route::name('returnUrl')->get('{driver}/{urlKey}/return', 'MerchantController@returnUrl');
        Route::name('webhookUrl')->post('{driver}/{urlKey}/webhook', 'MerchantController@webhookUrl');
    });
