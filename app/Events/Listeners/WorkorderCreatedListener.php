<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderCreated;
use FI\Modules\CustomFields\Models\WorkorderCustom;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Workorders\Support\WorkorderCalculate;

class WorkorderCreatedListener
{
    public function __construct(WorkorderCalculate $workorderCalculate)
    {
        $this->workorderCalculate = $workorderCalculate;
    }

    public function handle(WorkorderCreated $event)
    {
        // Create the empty workorder amount record
        $this->workorderCalculate->calculate($event->workorder);

        // Increment the next id
        Group::incrementNextId($event->workorder);

        // Create the custom workorder record.
        $event->workorder->custom()->save(new WorkorderCustom());
    }
}
