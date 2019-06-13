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
            'cc'         => [config('bt.mailDefaultCc')],
            'bcc'        => [config('bt.mailDefaultBcc')],
            'subject'    => trans('bt.workorder_status_change_notification'),
            'body'       => $parser->parse('workorderRejectedEmailBody'),
            'attach_pdf' => config('bt.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
