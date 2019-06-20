<?php

namespace BT\Composers;

use BT\Support\Statuses\PurchaseorderStatuses;

class PurchaseorderTableComposer
{
    public function compose($view)
    {
        $view->with('statuses', PurchaseorderStatuses::statuses());
    }
}
