<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Widgets\Dashboard\SchedulerSummary\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the view path
        view()->addLocation(app_path('Widgets/Dashboard/SchedulerSummary/Views'));

        // Register the widget view composer
        view()->composer('SchedulerSummaryWidget', 'BT\Widgets\Dashboard\SchedulerSummary\Composers\SchedulerSummaryWidgetComposer');

        // Widgets don't have route files so we'll place this here.
        Route::group(['middleware' => ['web','auth.admin'], 'namespace' => 'BT\Widgets\Dashboard\SchedulerSummary\Controllers'], function ()
        {
            Route::post('widgets/dashboard/scheduler_summary/render_partial', ['uses' => 'WidgetController@renderPartial', 'as' => 'widgets.dashboard.schedulerSummary.renderPartial']);
        });
    }

    public function register()
    {
        //
    }
}
