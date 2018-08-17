<?php

namespace FI\Events\Listeners;

use FI\Events\TimeTrackingProjectCreating;

class TimeTrackingProjectCreatingListener
{
    public function __construct()
    {
        //
    }

    public function handle(TimeTrackingProjectCreating $event)
    {
        $event->timetrackingproject->status_id = 1;
    }
}
