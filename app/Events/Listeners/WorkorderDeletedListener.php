<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderDeleted;
use FI\Modules\Groups\Models\Group;

class WorkorderDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(WorkorderDeleted $event)
    {
       /* foreach ($event->workorder->items as $item)
        {
            $item->delete();
        }*/

        foreach ($event->workorder->activities as $activity)
        {
            ($event->isForceDeleting()) ? $activity->onlyTrashed()->forceDelete() : $activity->delete();
        }

        foreach ($event->workorder->attachments as $attachment)
        {
            ($event->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($event->workorder->mailQueue as $mailQueue)
        {
            ($event->isForceDeleting()) ? $mailQueue->onlyTrashed()->forceDelete() : $mailQueue->delete();
        }

        foreach ($event->workorder->notes as $note)
        {
            ($event->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
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
