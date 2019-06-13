<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderEmailing;
use BT\Support\DateFormatter;

class WorkorderEmailingListener
{
    public function handle(WorkorderEmailing $event)
    {
        if (config('fi.resetWorkorderDateEmailDraft') and $event->workorder->status_text == 'draft')
        {
            $event->workorder->workorder_date = date('Y-m-d');
            $event->workorder->expires_at = DateFormatter::incrementDateByDays(date('Y-m-d'), config('fi.workordersExpireAfter'));
            $event->workorder->save();
        }
    }
}
