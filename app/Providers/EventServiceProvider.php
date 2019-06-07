<?php

namespace FI\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'FI\Events\CheckAttachment' => [
            'FI\Events\Listeners\CheckAttachmentListener',
        ],

        'FI\Events\InvoiceCreatedRecurring' => [
            'FI\Events\Listeners\InvoiceCreatedRecurringListener',
        ],

        'FI\Events\InvoiceEmailing' => [
            'FI\Events\Listeners\InvoiceEmailingListener',
        ],

        'FI\Events\InvoiceEmailed' => [
            'FI\Events\Listeners\InvoiceEmailedListener',
        ],

        'FI\Events\InvoiceModified' => [
            'FI\Events\Listeners\InvoiceModifiedListener',
        ],

        'FI\Events\InvoiceViewed' => [
            'FI\Events\Listeners\InvoiceViewedListener',
        ],

        'FI\Events\QuoteModified' => [
            'FI\Events\Listeners\QuoteModifiedListener',
        ],

        'FI\Events\QuoteEmailed' => [
            'FI\Events\Listeners\QuoteEmailedListener',
        ],

        'FI\Events\QuoteEmailing' => [
            'FI\Events\Listeners\QuoteEmailingListener',
        ],

        'FI\Events\QuoteApproved' => [
            'FI\Events\Listeners\QuoteApprovedListener',
        ],

        'FI\Events\QuoteRejected' => [
            'FI\Events\Listeners\QuoteRejectedListener',
        ],

        'FI\Events\QuoteViewed' => [
            'FI\Events\Listeners\QuoteViewedListener',
        ],

        'FI\Events\RecurringInvoiceModified' => [
            'FI\Events\Listeners\RecurringInvoiceModifiedListener',
        ],

        'FI\Events\WorkorderModified' => [
            'FI\Events\Listeners\WorkorderModifiedListener',
        ],

        'FI\Events\WorkorderEmailed' => [
            'FI\Events\Listeners\WorkorderEmailedListener',
        ],

        'FI\Events\WorkorderEmailing' => [
            'FI\Events\Listeners\WorkorderEmailingListener',
        ],

        'FI\Events\WorkorderApproved' => [
            'FI\Events\Listeners\WorkorderApprovedListener',
        ],

        'FI\Events\WorkorderRejected' => [
            'FI\Events\Listeners\WorkorderRejectedListener',
        ],

        'FI\Events\WorkorderViewed' => [
            'FI\Events\Listeners\WorkorderViewedListener',
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
