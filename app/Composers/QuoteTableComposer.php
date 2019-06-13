<?php

namespace BT\Composers;

use BT\Support\Statuses\QuoteStatuses;

class QuoteTableComposer
{
    public function compose($view)
    {
        $view->with('statuses', QuoteStatuses::statuses());
    }
}
