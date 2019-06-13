<?php

namespace BT\Events;

use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use Illuminate\Queue\SerializesModels;

class InvoiceCreatedRecurring extends Event
{
    use SerializesModels;

    public function __construct(Invoice $invoice, RecurringInvoice $recurringInvoice)
    {
        $this->invoice          = $invoice;
        $this->recurringInvoice = $recurringInvoice;
    }
}
