<?php

namespace BT\Observers;

use BT\Events\CheckAttachment;
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\CustomFields\Models\ExpenseCustom;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Categories\Models\Category;
use BT\Modules\Vendors\Models\Vendor;

class ExpenseObserver
{
    public function created(Expense $expense): void
    {
        // Create the default custom record.
        $expense->custom()->save(new ExpenseCustom());
    }

    public function deleting(Expense $expense): void
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

        if ($expense->company_profile)
        {
            if (!CompanyProfile::where('company', $expense->company_profile)->count())
            {
                $expense->company_profile_id = config('bt.defaultCompanyProfile');
            }
        }

        unset($expense->company_profile);
    }
}
