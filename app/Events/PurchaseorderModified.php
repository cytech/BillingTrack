<?php

namespace BT\Events;

use BT\Modules\Purchaseorders\Models\Purchaseorder;
use Illuminate\Queue\SerializesModels;

class PurchaseorderModified extends Event
{
    use SerializesModels;

    public function __construct(Purchaseorder $purchaseorder)
    {
        $this->purchaseorder = $purchaseorder;
    }
}
