<?php

namespace BT\Observers;

use BT\Modules\MailQueue\Support\MailQueue;
use BT\Modules\Notes\Models\Note;

class NoteObserver
{
    public function __construct(MailQueue $mailQueue)
    {
        $this->mailQueue = $mailQueue;
    }
    /**
     * Handle the note "created" event.
     *
     * @param  \BT\Modules\Notes\Models\Note  $note
     * @return void
     */
    public function created(Note $note): void
    {
        if (auth()->user()->client_id) {
            $mail = $this->mailQueue->create($note->notable, [
                'to'         => [$note->notable->user->email],
                'cc'         => [config('bt.mailDefaultCc')],
                'bcc'        => [config('bt.mailDefaultBcc')],
                'subject'    => trans('bt.note_notification'),
                'body'       => $note->formatted_note,
                'attach_pdf' => config('bt.attachPdf'),
            ]);

            $this->mailQueue->send($mail->id);
        }
    }
}
