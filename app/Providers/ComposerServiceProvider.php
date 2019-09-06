<?php

namespace BT\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.master', 'BT\Composers\LayoutComposer');
        view()->composer(['client_center.layouts.master', 'client_center.layouts.public', 'layouts.master'], 'BT\Composers\SkinComposer');
        view()->composer('clients._form', 'BT\Composers\ClientFormComposer');
        view()->composer('vendors._form', 'BT\Composers\VendorFormComposer');
        view()->composer('invoices._table', 'BT\Composers\InvoiceTableComposer');
        view()->composer('purchaseorders._table', 'BT\Composers\PurchaseorderTableComposer');
        view()->composer('quotes._table', 'BT\Composers\QuoteTableComposer');
        view()->composer('workorders.partials._table', 'BT\Composers\WorkorderTableComposer');
        view()->composer('reports.options.*', 'BT\Composers\ReportComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
