<?php

namespace BT\Widgets\Dashboard\WorkorderSummary\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the view path
        view()->addLocation(app_path('Widgets/Dashboard/WorkorderSummary/Views'));

        // Register the widget view composer
        view()->composer('WorkorderSummaryWidget', 'BT\Widgets\Dashboard\WorkorderSummary\Composers\WorkorderSummaryWidgetComposer');

        // Register the setting view composer
        view()->composer('WorkorderSummaryWidgetSettings', 'BT\Widgets\Dashboard\WorkorderSummary\Composers\WorkorderSummarySettingComposer');

        // Widgets don't have route files so we'll place this here.
        Route::group(['middleware' => ['web','auth.admin'], 'namespace' => 'BT\Widgets\Dashboard\WorkorderSummary\Controllers'], function ()
        {
            Route::post('widgets/dashboard/workorder_summary/render_partial', ['uses' => 'WidgetController@renderPartial', 'as' => 'widgets.dashboard.workorderSummary.renderPartial']);
        });
    }

    public function register()
    {
        //
    }
}
