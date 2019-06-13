<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderEmailed;
use BT\Support\Statuses\WorkorderStatuses;

class WorkorderEmailedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WorkorderEmailed $event
     * @return void
     */
    public function handle(WorkorderEmailed $event)
    {
        // Change the status to sent if the status is currently draft
        if ($event->workorder->workorder_status_id == WorkorderStatuses::getStatusId('draft'))
        {
            $event->workorder->workorder_status_id = WorkorderStatuses::getStatusId('sent');
            $event->workorder->save();
        }
    }
}
