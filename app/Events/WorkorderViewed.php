<?php

namespace BT\Events;

use BT\Modules\Workorders\Models\Workorder;

use Illuminate\Queue\SerializesModels;

class WorkorderViewed extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Workorder $workorder)
    {
        $this->workorder = $workorder;
    }
}
