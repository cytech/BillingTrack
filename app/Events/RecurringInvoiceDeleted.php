<?php

namespace FI\Events;

use FI\Modules\RecurringInvoices\Models\RecurringInvoice;

use Illuminate\Queue\SerializesModels;

class RecurringInvoiceDeleted extends Event
{
    use SerializesModels;

    public function __construct(RecurringInvoice $recurringinvoice)
    {
        $this->recurringinvoice = $recurringinvoice;
    }
}
