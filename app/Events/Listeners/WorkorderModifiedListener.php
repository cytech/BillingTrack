<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderModified;
use BT\Modules\Workorders\Support\WorkorderCalculate;

class WorkorderModifiedListener
{
    public function __construct(WorkorderCalculate $workorderCalculate)
    {
        $this->workorderCalculate = $workorderCalculate;
    }

    public function handle(WorkorderModified $event)
    {
        // Calculate the workorder and item amounts
        $this->workorderCalculate->calculate($event->workorder);
    }
}
