<?php

namespace BT\Events\Listeners;

use BT\Events\InvoiceEmailing;
use BT\Support\DateFormatter;

class InvoiceEmailingListener
{
    public function handle(InvoiceEmailing $event)
    {
        if (config('bt.resetInvoiceDateEmailDraft') and $event->invoice->status_text == 'draft')
        {
            $event->invoice->invoice_date = date('Y-m-d');
            $event->invoice->due_at       = DateFormatter::incrementDateByDays(date('Y-m-d'),  $event->invoice->client->client_terms);
            $event->invoice->save();
        }
    }
}
