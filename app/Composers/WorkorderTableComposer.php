<?php

namespace BT\Composers;

use BT\Support\Statuses\WorkorderStatuses;

class WorkorderTableComposer
{
    public function compose($view)
    {
        $view->with('statuses', WorkorderStatuses::statuses());
    }
}
