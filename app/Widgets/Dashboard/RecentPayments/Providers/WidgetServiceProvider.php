<?php

namespace BT\Widgets\Dashboard\RecentPayments\Providers;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the view path.
        view()->addLocation(app_path('Widgets/Dashboard/RecentPayments/Views'));

        // Register the widget view composer.
        view()->composer('RecentPaymentsWidget', 'BT\Widgets\Dashboard\RecentPayments\Composers\RecentPaymentsWidgetComposer');
    }

    public function register()
    {
        //
    }
}
