<?php

namespace BT\Events\Listeners;

use BT\Events\InvoiceModified;
use BT\Modules\Invoices\Support\InvoiceCalculate;

class InvoiceModifiedListener
{
    public function __construct(InvoiceCalculate $invoiceCalculate)
    {
        $this->invoiceCalculate = $invoiceCalculate;
    }

    public function handle(InvoiceModified $event)
    {
        $this->invoiceCalculate->calculate($event->invoice);
    }
}
