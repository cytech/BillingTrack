<?php

namespace FI\Events;

use FI\Modules\Workorders\Models\WorkorderItem;

use Illuminate\Queue\SerializesModels;

class WorkorderItemSaving extends Event
{
    use SerializesModels;

    public function __construct(WorkorderItem $workorderItem)
    {
        $this->workorderItem = $workorderItem;
    }
}
