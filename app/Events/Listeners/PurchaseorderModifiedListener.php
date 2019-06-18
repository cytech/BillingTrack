<?php

namespace BT\Events\Listeners;

use BT\Events\PurchaseorderModified;
use BT\Modules\Purchaseorders\Support\PurchaseorderCalculate;

class PurchaseorderModifiedListener
{
    public function __construct(PurchaseorderCalculate $purchaseorderCalculate)
    {
        $this->purchaseorderCalculate = $purchaseorderCalculate;
    }

    public function handle(PurchaseorderModified $event)
    {
        $this->purchaseorderCalculate->calculate($event->purchaseorder);
    }
}
