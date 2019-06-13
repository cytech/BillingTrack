<?php

namespace BT\Observers;

use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\CustomFields\Models\CompanyProfileCustom;

class CompanyProfileObserver
{
    /**
     * Handle the company profile "created" event.
     *
     * @param  \BT\Modules\CompanyProfiles\Models\CompanyProfile  $companyProfile
     * @return void
     */
    public function created(CompanyProfile $companyProfile): void
    {
        $companyProfile->custom()->save(new CompanyProfileCustom());
    }

    public function creating(CompanyProfile $companyProfile): void
    {
        if (!$companyProfile->invoice_template)
        {
            $companyProfile->invoice_template = config('fi.invoiceTemplate');
        }

        if (!$companyProfile->quote_template)
        {
            $companyProfile->quote_template = config('fi.quoteTemplate');
        }    }

    public function saving(CompanyProfile $companyProfile): void
    {
        $companyProfile->custom()->save(new CompanyProfileCustom());
    }
}
