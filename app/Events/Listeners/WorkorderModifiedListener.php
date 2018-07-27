<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderModified;
use FI\Modules\Workorders\Support\WorkorderCalculate;
use FI\Modules\Workorders\Repositories\WorkorderToSchedulerRepository;

class WorkorderModifiedListener
{
    public function __construct(WorkorderCalculate $workorderCalculate)
                                //WorkorderToSchedulerRepository $workorderToSchedulerRepository)
    {
        $this->workorderCalculate = $workorderCalculate;
        //$this->workorderToSchedulerRepository = $workorderToSchedulerRepository;
    }

    public function handle(WorkorderModified $event)
    {
        // Calculate the workorder and item amounts
        $this->workorderCalculate->calculate($event->workorder);

        // Update the event in Scheduler
//        if (config('fi.scheduler')) {
//            $this->workorderToSchedulerRepository->update($event->workorder->id);
//        }


    }
}
