<?php

namespace FI\Observers;

use FI\Events\CheckAttachment;
use FI\Modules\Clients\Models\Client;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\CustomFields\Models\ExpenseCustom;
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Categories\Models\Category;
use FI\Modules\Vendors\Models\Vendor;

class ExpenseObserver
{
    public function created(Expense $expense): void
    {
        // Create the default custom record.
        $expense->custom()->save(new ExpenseCustom());
    }

    public function deleteing(Expense $expense): void
    {
        foreach ($expense->attachments as $attachment)
        {
            ($expense->isForceDeleting()) ? $attachment->onlyTrashed()->forceDelete() : $attachment->delete();
        }
    }

    public function saved(Expense $expense): void
    {
        event(new CheckAttachment($expense));
    }

    public function saving(Expense $expense): void
    {
        if (!$expense->id)
        {
            $expense->user_id = auth()->user()->id;
        }

        if ($expense->category_name)
        {
            $expense->category_id = Category::firstOrCreate(['name' => $expense->category_name])->id;
        }

        if (isset($expense->vendor_name) and $expense->vendor_name)
        {
            $expense->vendor_id = Vendor::firstOrCreate(['name' => $expense->vendor_name])->id;
        }
        elseif (isset($expense->vendor_name))
        {
            $expense->vendor_id = 0;
        }

        if ($expense->company_profile)
        {
            if (!CompanyProfile::where('company', $expense->company_profile)->count())
            {
                $expense->company_profile_id = config('fi.defaultCompanyProfile');
            }
        }

        if (isset($expense->client_name) and $expense->client_name)
        {
            $expense->client_id = Client::firstOrCreateByUniqueName($expense->client_name)->id;
        }
        elseif (isset($expense->client_name))
        {
            $expense->client_id = 0;
        }

        unset($expense->company_profile, $expense->client_name, $expense->vendor_name, $expense->category_name);
    }
}
