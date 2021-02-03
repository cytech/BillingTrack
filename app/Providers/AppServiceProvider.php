<?php

/*
 * Routes note laravel undocumented  https://github.com/laravel/framework/issues/19020
 * when loading custom routes in AppServiceProvider, the name() method in the loaded routes.php
 * has to be first or it does not get initialized with the route properly
 * WORKS
 *         Route::name('index')->get('/', 'CategoriesController@index');
 * DOES NOT WORK
 *         Route::get('/', 'CategoriesController@index')->name('index');
*/


namespace BT\Providers;

use BT\Support\Directory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('proxies.trust_all'))
        {
            request()->setTrustedProxies([request()->getClientIp()]);
        }

        if (!$this->app->environment('testing') and $this->app->config->get('app.key') == 'ReplaceThisWithYourOwnLicenseKey')
        {
            session()->flash('error', '<strong>' . trans('bt.error') . '</strong> - ' . 'Please enter your license key in config/app.php.');
        }

        $this->app->view->addLocation(base_path('custom/overrides'));

        $modules = Directory::listDirectories(app_path('Modules'));

        foreach ($modules as $module)
        {
            $routesPath = app_path('Modules/' . $module . '/routes.php');
            $viewsPath  = app_path('Modules/' . $module . '/Views');

            if (file_exists($routesPath))
            {
                require $routesPath;
            }

            if (file_exists($viewsPath))
            {
                $this->app->view->addLocation($viewsPath);
            }
        }

        foreach (File::files(app_path('Helpers')) as $helper)
        {
            require_once $helper;
        }

        $this->app->view->addLocation(base_path('custom/templates'));
        $this->app->view->addLocation(storage_path());

        $this->app->register('BT\Providers\AddonServiceProvider');
        $this->app->register('BT\Providers\ComposerServiceProvider');
        $this->app->register('BT\Providers\ConfigServiceProvider');
        $this->app->register('BT\Providers\DashboardWidgetServiceProvider');
        $this->app->register('BT\Providers\EventServiceProvider');
        $this->app->register('BT\Providers\ObserverServiceProvider');

        // $this->app->register('Collective\Html\HtmlServiceProvider');

        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function()
        {
           $loader = AliasLoader::getInstance();
           $loader->alias('Sortable', 'BT\Traits\Sortable');
        });
    }
}
