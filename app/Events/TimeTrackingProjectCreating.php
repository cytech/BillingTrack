<?php

namespace FI\Events;

use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use Illuminate\Queue\SerializesModels;

class TimeTrackingProjectCreating extends Event
{
    use SerializesModels;

    public function __construct(TimeTrackingProject $timetrackingproject)
    {
        $this->timetrackingproject = $timetrackingproject;
    }
}
