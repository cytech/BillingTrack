<?php

namespace BT\Composers;

use BT\Support\Statuses\InvoiceStatuses;

class InvoiceTableComposer
{
    public function compose($view)
    {
        $view->with('statuses', InvoiceStatuses::statuses());
    }
}
