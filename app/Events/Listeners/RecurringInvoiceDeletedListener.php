<?php

namespace FI\Events\Listeners;

use FI\Events\RecurringInvoiceDeleted;

class RecurringInvoiceDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(RecurringInvoiceDeleted $event)
    {
        foreach ($event->recurringinvoice->activities as $activity)
        {
            ($event->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }
    }
}
