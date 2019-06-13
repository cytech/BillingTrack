<?php

namespace BT\Events;

use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use Illuminate\Queue\SerializesModels;

class RecurringInvoiceModified extends Event
{
    use SerializesModels;

    public $recurringInvoice;

    public function __construct(RecurringInvoice $recurringInvoice)
    {
        $this->recurringInvoice = $recurringInvoice;
    }
}
