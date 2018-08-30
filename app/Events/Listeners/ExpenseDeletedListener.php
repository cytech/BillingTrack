<?php

namespace FI\Events\Listeners;

use FI\Events\ExpenseDeleted;

class ExpenseDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(ExpenseDeleted $event)
    {
        foreach ($event->expense->attachments as $attachment)
        {
            ($event->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }
    }
}
