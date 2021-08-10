<?php

namespace BT\Observers;

use BT\Modules\Vendors\Models\Vendor;
use BT\Modules\CustomFields\Models\VendorCustom;

class VendorObserver
{
    /**
     * Listen to the Vendor created event.
     */
    public function created(Vendor $vendor): void
    {
        // Create the default custom record.
        $vendor->custom()->save(new VendorCustom());
    }
    /**
     * Listen to the Vendor creating event.
     */
    public function creating(Vendor $vendor): void
    {
        if (!$vendor->currency_code)
        {
            $vendor->currency_code = config('bt.baseCurrency');
        }

        if (!$vendor->language)
        {
            $vendor->language = config('bt.language');
        }
    }

    /**
     * Listen to the Vendor saving event.
     */
    public function saving(Vendor $vendor): void
    {
        $vendor->name    = strip_tags($vendor->name);
        $vendor->address = strip_tags($vendor->address);


    }
    /**
     * Listen to the Vendor deleting event.
     */
    public function deleting(Vendor $vendor): void
    {
        foreach ($vendor->notes as $note)
        {
            ($vendor->isForceDeleting()) ? $note->onlyTrashed()->forceDelete() : $note->delete();
        }

        foreach ($vendor->attachments as $attachment)
        {
            ($vendor->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }

    }

    /**
     * Listen to the Vendor restoring event.
     */
    public function restoring(Vendor $vendor): void
    {
        foreach ($vendor->attachments as $attachment) {
            $attachment->onlyTrashed()->restore();
        }

        foreach ($vendor->notes as $note) {
            $note->onlyTrashed()->restore();
        }

    }

}
