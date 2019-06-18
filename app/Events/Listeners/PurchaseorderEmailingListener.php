<?php

namespace BT\Events\Listeners;

use BT\Events\PurchaseorderEmailing;
use BT\Support\DateFormatter;

class PurchaseorderEmailingListener
{
    public function handle(PurchaseorderEmailing $event)
    {
        if (config('bt.resetPurchaseorderDateEmailDraft') and $event->purchaseorder->status_text == 'draft')
        {
            $event->purchaseorder->purchaseorder_date = date('Y-m-d');
            $event->purchaseorder->due_at       = DateFormatter::incrementDateByDays(date('Y-m-d'),  $event->purchaseorder->vendor->vendor_terms);
            $event->purchaseorder->save();
        }
    }
}
