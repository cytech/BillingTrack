<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderDeleted;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Workorders\Repositories\WorkorderToSchedulerRepository;

class WorkorderDeletedListener
{
//    public function __construct(WorkorderToSchedulerRepository $workorderToSchedulerRepository)
//    {
//        $this->workorderToSchedulerRepository = $workorderToSchedulerRepository;
//    }

    public function handle(WorkorderDeleted $event)
    {
        // Delete the event in Scheduler
//        if (config('fi.scheduler')) {
//            $this->workorderToSchedulerRepository->delete($event->workorder->id);
//        }

       /* foreach ($event->workorder->items as $item)
        {
            $item->delete();
        }*/

        foreach ($event->workorder->activities as $activity)
        {
            $activity->delete();
        }

        foreach ($event->workorder->mailQueue as $mailQueue)
        {
            $mailQueue->delete();
        }

        foreach ($event->workorder->notes as $note)
        {
            $note->delete();
        }

        /*$event->workorder->custom()->delete();*/
        /*$event->workorder->amount()->delete();*/

        $group = Group::where('id', $event->workorder->group_id)
            ->where('last_number', $event->workorder->number)
            ->first();

        if ($group)
        {
            $group->next_id = $group->next_id - 1;
            $group->save();
        }
    }
}
