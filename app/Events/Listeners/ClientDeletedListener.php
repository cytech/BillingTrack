<?php

namespace FI\Events\Listeners;

use FI\Events\ClientDeleted;

class ClientDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(ClientDeleted $event)
    {
        /*foreach ($event->client->quotes as $quote)
        {
            $quote->delete();
        }

        foreach ($event->client->invoices as $invoice)
        {
            $invoice->delete();
        }

        foreach ($event->client->recurringInvoices as $recurringInvoice)
        {
            $recurringInvoice->delete();
        }*/

        foreach ($event->client->notes as $note)
        {
            ($event->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        foreach ($event->client->attachments as $attachment)
        {
            ($event->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

        foreach ($event->client->expenses as $expense)
        {
            ($event->isForceDeleting()) ? $expense->onlyTrashed()->forceDelete() : $expense->delete();
        }

        /*foreach ($event->client->contacts as $contact)
        {
            $contact->delete();
        }*/

        //not used
        /*if ($event->client->user)
        {
            $event->client->user->delete();
        }*/

        /*if ($event->client->custom)
        {
            $event->client->custom->delete();
        }*/

        /*if ($event->client->merchant)
        {
            $event->client->merchant->delete();
        }*/
    }
}
