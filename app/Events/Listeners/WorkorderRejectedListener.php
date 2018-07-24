<?php

namespace FI\Events\Listeners;

use FI\Events\WorkorderRejected;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;

class WorkorderRejectedListener
{
    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue           = $mailQueue;
    }

    public function handle(WorkorderRejected $event)
    {
        $event->workorder->activities()->create(['activity' => 'public.rejected']);

        $parser = new Parser($event->workorder);

        $mail = $this->mailQueue->create($event->workorder, [
            'to'         => [$event->workorder->user->email],
            'cc'         => [config('fi.mailDefaultCc')],
            'bcc'        => [config('fi.mailDefaultBcc')],
            'subject'    => trans('fi.workorder_status_change_notification'),
            'body'       => $parser->parse('workorderRejectedEmailBody'),
            'attach_pdf' => config('fi.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
