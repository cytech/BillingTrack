<?php

namespace BT\Events\Listeners;

use BT\Events\InvoiceCreatedRecurring;
use BT\Events\InvoiceEmailed;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Support\Parser;

class InvoiceCreatedRecurringListener
{
    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }

    public function handle(InvoiceCreatedRecurring $event)
    {
        if (config('bt.automaticEmailOnRecur') and $event->invoice->client->email)
        {
            $parser = new Parser($event->invoice);

            if (!$event->invoice->is_overdue)
            {
                $subject = $parser->parse('invoiceEmailSubject');
                $body    = $parser->parse('invoiceEmailBody');
            }
            else
            {
                $subject = $parser->parse('overdueInvoiceEmailSubject');
                $body    = $parser->parse('overdueInvoiceEmailBody');
            }

            $mail = $this->mailQueue->create($event->invoice, [
                'to'         => [$event->invoice->client->email],
                'cc'         => [config('bt.mailDefaultCc')],
                'bcc'        => [config('bt.mailDefaultBcc')],
                'subject'    => $subject,
                'body'       => $body,
                'attach_pdf' => config('bt.attachPdf'),
            ]);

            $this->mailQueue->send($mail->id);

            event(new InvoiceEmailed($event->invoice));
        }
    }
}
