<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\CompanyProfiles\Controllers')
    ->prefix('company_profiles')->name('companyProfiles.')->group(function () {
        Route::name('index')->get('/', 'CompanyProfileController@index');
        Route::name('create')->get('create', 'CompanyProfileController@create');
        Route::name('edit')->get('{id}/edit', 'CompanyProfileController@edit');
        Route::name('delete')->get('{id}/delete', 'CompanyProfileController@delete');

        Route::name('store')->post('/', 'CompanyProfileController@store');
        Route::name('update')->post('{id}', 'CompanyProfileController@update');

        Route::name('deleteLogo')->post('{id}/delete_logo', 'CompanyProfileController@deleteLogo');
        Route::name('ajax.modalLookup')->post('ajax/modal_lookup', 'CompanyProfileController@ajaxModalLookup');
    });

Route::name('logo')->get('{id}/logo', 'BT\Modules\CompanyProfiles\Controllers\LogoController@logo');
