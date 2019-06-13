<?php

namespace BT\Observers;

use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Settings\Models\Setting;

class SettingObserver
{
    /**
     * Handle the setting "saving" event.
     *
     * @param  \BT\Modules\Settings\Models\Setting  $setting
     * @return void
     */
    public function saving(Setting $setting): void
    {
        if ($setting->setting_key == 'invoiceTemplate' or $setting->setting_key == 'quoteTemplate' or $setting->setting_key == 'workorderTemplate')
        {
            $original = $setting->getOriginal();

            if (isset($original['setting_value']) and $original['setting_value'] !== $setting->setting_value)
            {
                $templateType     = $setting->setting_key;
                $originalTemplate = $original['setting_value'];
                $newTemplate      = $setting->setting_value;

                if ($templateType == 'invoiceTemplate')
                {
                    CompanyProfile::whereNull('invoice_template')->orWhere('invoice_template', $originalTemplate)->orWhere('invoice_template', '')->update(['invoice_template' => $newTemplate]);
                }
                elseif ($templateType == 'quoteTemplate')
                {
                    CompanyProfile::whereNull('quote_template')->orWhere('quote_template', $originalTemplate)->orWhere('quote_template', '')->update(['quote_template' => $newTemplate]);
                }
                elseif ($templateType == 'quoteTemplate')
                {
                    CompanyProfile::whereNull('workorder_template')->orWhere('workorder_template', $originalTemplate)->orWhere('workorder_template', '')->update(['workorder_template' => $newTemplate]);
                }
            }
        }
    }
}
