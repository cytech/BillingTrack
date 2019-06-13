<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderViewed;

class WorkorderViewedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WorkorderViewed $event
     * @return void
     */
    public function handle(WorkorderViewed $event)
    {
        if (request('disableFlag') != 1)
        {
            if (auth()->guest() or auth()->user()->user_type == 'client')
            {
                $event->workorder->activities()->create(['activity' => 'public.viewed']);
                $event->workorder->viewed = 1;
                $event->workorder->save();
            }
        }
    }
}
