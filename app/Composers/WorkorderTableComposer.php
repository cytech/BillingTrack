<?php

namespace FI\Composers;

use FI\Support\Statuses\WorkorderStatuses;

class WorkorderTableComposer
{
    public function compose($view)
    {
        $view->with('statuses', WorkorderStatuses::statuses());
    }
}