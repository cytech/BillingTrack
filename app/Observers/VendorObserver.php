<?php

namespace FI\Observers;

use FI\Modules\Vendors\Models\Vendor;
use FI\Modules\CustomFields\Models\VendorCustom;

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
            $vendor->currency_code = config('fi.baseCurrency');
        }

        if (!$vendor->language)
        {
            $vendor->language = config('fi.language');
        }
    }
    /**
     * Listen to the Vendor deleted event.
     */
    public function deleteing(Vendor $vendor): void
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
     * Listen to the Vendor saving event.
     */
    public function saving(Vendor $vendor): void
    {
        $vendor->name    = strip_tags($vendor->name);
        $vendor->address = strip_tags($vendor->address);


    }
}
