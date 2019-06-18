<?php

namespace BT\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'BT\Events\CheckAttachment' => [
            'BT\Events\Listeners\CheckAttachmentListener',
        ],

        'BT\Events\InvoiceCreatedRecurring' => [
            'BT\Events\Listeners\InvoiceCreatedRecurringListener',
        ],

        'BT\Events\InvoiceEmailing' => [
            'BT\Events\Listeners\InvoiceEmailingListener',
        ],

        'BT\Events\InvoiceEmailed' => [
            'BT\Events\Listeners\InvoiceEmailedListener',
        ],

        'BT\Events\InvoiceModified' => [
            'BT\Events\Listeners\InvoiceModifiedListener',
        ],

        'BT\Events\PurchaseorderModified' => [
            'BT\Events\Listeners\PurchaseorderModifiedListener',
        ],

        'BT\Events\PurchaseorderEmailing' => [
            'BT\Events\Listeners\PurchaseorderEmailingListener',
        ],

        'BT\Events\PurchaseorderEmailed' => [
            'BT\Events\Listeners\PurchaseorderEmailedListener',
        ],

        'BT\Events\InvoiceViewed' => [
            'BT\Events\Listeners\InvoiceViewedListener',
        ],

        'BT\Events\QuoteModified' => [
            'BT\Events\Listeners\QuoteModifiedListener',
        ],

        'BT\Events\QuoteEmailed' => [
            'BT\Events\Listeners\QuoteEmailedListener',
        ],

        'BT\Events\QuoteEmailing' => [
            'BT\Events\Listeners\QuoteEmailingListener',
        ],

        'BT\Events\QuoteApproved' => [
            'BT\Events\Listeners\QuoteApprovedListener',
        ],

        'BT\Events\QuoteRejected' => [
            'BT\Events\Listeners\QuoteRejectedListener',
        ],

        'BT\Events\QuoteViewed' => [
            'BT\Events\Listeners\QuoteViewedListener',
        ],

        'BT\Events\RecurringInvoiceModified' => [
            'BT\Events\Listeners\RecurringInvoiceModifiedListener',
        ],

        'BT\Events\WorkorderModified' => [
            'BT\Events\Listeners\WorkorderModifiedListener',
        ],

        'BT\Events\WorkorderEmailed' => [
            'BT\Events\Listeners\WorkorderEmailedListener',
        ],

        'BT\Events\WorkorderEmailing' => [
            'BT\Events\Listeners\WorkorderEmailingListener',
        ],

        'BT\Events\WorkorderApproved' => [
            'BT\Events\Listeners\WorkorderApprovedListener',
        ],

        'BT\Events\WorkorderRejected' => [
            'BT\Events\Listeners\WorkorderRejectedListener',
        ],

        'BT\Events\WorkorderViewed' => [
            'BT\Events\Listeners\WorkorderViewedListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
