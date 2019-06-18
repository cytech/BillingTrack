<?php

namespace BT\Events\Listeners;

use BT\Events\PurchaseorderEmailed;
use BT\Support\Statuses\PurchaseorderStatuses;

class PurchaseorderEmailedListener
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
     * @param  PurchaseorderEmailed $event
     * @return void
     */
    public function handle(PurchaseorderEmailed $event)
    {
        // Change the status to sent if the status is currently draft
        if ($event->purchaseorder->purchaseorder_status_id == PurchaseorderStatuses::getStatusId('draft'))
        {
            $event->purchaseorder->purchaseorder_status_id = PurchaseorderStatuses::getStatusId('sent');
            $event->purchaseorder->save();
        }
    }
}
