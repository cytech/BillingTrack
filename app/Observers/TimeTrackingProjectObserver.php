<?php

namespace BT\Observers;


use BT\Modules\TimeTracking\Models\TimeTrackingProject;

class TimeTrackingProjectObserver
{
    /**
     * Handle the time tracking project "created" event.
     *
     * @param  \BT\Modules\TimeTracking\Models\TimeTrackingProject  $timeTrackingProject
     * @return void
     */
    public function creating(TimeTrackingProject $timeTrackingProject): void
    {
        $timeTrackingProject->status_id = 1;

    }
}
