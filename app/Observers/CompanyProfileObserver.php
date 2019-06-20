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
            $companyProfile->invoice_template = config('bt.invoiceTemplate');
        }

        if (!$companyProfile->quote_template)
        {
            $companyProfile->quote_template = config('bt.quoteTemplate');
        }

        if (!$companyProfile->currency_code)
        {
            $companyProfile->currency_code = config('bt.baseCurrency');
        }

        if (!$companyProfile->language)
        {
            $companyProfile->language = config('bt.language');
        }
    }

    public function saving(CompanyProfile $companyProfile): void
    {
        $companyProfile->address = strip_tags($companyProfile->address);
    }
}
