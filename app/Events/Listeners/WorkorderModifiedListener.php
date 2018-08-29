<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderModified;
use FI\Modules\Workorders\Support\WorkorderCalculate;

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
