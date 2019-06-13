<?php

namespace BT\Events\Listeners;

use BT\Events\WorkorderRejected;
use BT\Modules\MailQueue\Support\MailQueue;
use BT\Support\Parser;

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
