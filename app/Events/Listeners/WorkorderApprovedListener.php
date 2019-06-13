<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderApproved;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Workorders\Support\WorkorderToInvoice;
use BT\Support\DateFormatter;
use BT\Support\Parser;

class WorkorderApprovedListener
{
     public function __construct(MailQueue $mailQueue, WorkorderToInvoice $workorderToInvoice)
    {
        $this->mailQueue              = $mailQueue;
        $this->workorderToInvoice = $workorderToInvoice;
    }

    public function handle(WorkorderApproved $event)
    {
        // Create the activity record
        $event->workorder->activities()->create(['activity' => 'public.approved']);

        // If applicable, convert the workorder to an invoice when workorder is approved
        if (config('bt.convertWorkorderWhenApproved'))
        {
            $this->workorderToInvoice->convert(
                $event->workorder,
                date('Y-m-d'),
                DateFormatter::incrementDateByDays(date('Y-m-d'),  $event->workorder->client->client_terms),
                config('bt.invoiceGroup')
            );
        }

        $parser = new Parser($event->workorder);

        $mail = $this->mailQueue->create($event->workorder, [
            'to'         => [$event->workorder->user->email],
            'cc'         => [config('bt.mailDefaultCc')],
            'bcc'        => [config('bt.mailDefaultBcc')],
            'subject'    => trans('bt.workorder_status_change_notification'),
            'body'       => $parser->parse('workorderApprovedEmailBody'),
            'attach_pdf' => config('bt.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
