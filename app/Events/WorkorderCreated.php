<?php

namespace FI\Events;

use FI\Modules\Workorders\Models\Workorder;

use Illuminate\Queue\SerializesModels;

class WorkorderCreated extends Event
{
    use SerializesModels;

    public function __construct(Workorder $workorder)
    {
        $this->workorder = $workorder;
    }
}