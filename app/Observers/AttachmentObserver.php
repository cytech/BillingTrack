<?php

namespace BT\Observers;

use BT\Modules\Attachments\Models\Attachment;

class AttachmentObserver
{
    public function creating(Attachment $attachment): void
    {
        $attachment->url_key = str_random(64);

    }

    public function deleting(Attachment $attachment): void
    {
        $filePath = $attachment->attachable->attachment_path . '/' . $attachment->filename;

        if (file_exists($filePath))
        {
            if ($attachment->isForceDeleting()){ unlink($filePath);}
        }
    }
}
