<?php

namespace BT\Events\Listeners;

use BT\Events\QuoteApproved;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Quotes\Support\QuoteToInvoice;
use BT\Support\DateFormatter;
use BT\Support\Parser;

class QuoteApprovedListener
{
    public function __construct(MailQueue $mailQueue, QuoteToInvoice $quoteToInvoice)
    {
        $this->mailQueue      = $mailQueue;
        $this->quoteToInvoice = $quoteToInvoice;
    }

    public function handle(QuoteApproved $event)
    {
        // Create the activity record
        $event->quote->activities()->create(['activity' => 'public.approved']);

        // If applicable, convert the quote to an invoice when quote is approved
        if (config('bt.convertQuoteWhenApproved'))
        {
            $this->quoteToInvoice->convert(
                $event->quote,
                date('Y-m-d'),
                DateFormatter::incrementDateByDays(date('Y-m-d'),  $event->quote->client->client_terms),
                config('bt.invoiceGroup')
            );
        }

        $parser = new Parser($event->quote);

        $mail = $this->mailQueue->create($event->quote, [
            'to'         => [$event->quote->user->email],
            'cc'         => [config('bt.mailDefaultCc')],
            'bcc'        => [config('bt.mailDefaultBcc')],
            'subject'    => trans('bt.quote_status_change_notification'),
            'body'       => $parser->parse('quoteApprovedEmailBody'),
            'attach_pdf' => config('bt.attachPdf'),
        ]);

        $this->mailQueue->send($mail->id);
    }
}
