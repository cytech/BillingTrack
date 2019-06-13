<?php

namespace BT\Composers;

use BT\Modules\CompanyProfiles\Models\CompanyProfile;

class ReportComposer
{
    public function compose($view)
    {
        $view->with('companyProfiles', ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList());
    }
}
