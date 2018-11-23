<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Settings\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Currencies\Models\Currency;
use FI\Modules\Groups\Models\Group;
use FI\Modules\Invoices\Support\InvoiceTemplates;
use FI\Modules\MailQueue\Support\MailSettings;
use FI\Modules\Merchant\Support\MerchantFactory;
use FI\Modules\PaymentMethods\Models\PaymentMethod;
use FI\Modules\Quotes\Support\QuoteTemplates;
use FI\Modules\Settings\Models\Setting;
use FI\Modules\Settings\Requests\SettingUpdateRequest;
use FI\Modules\TaxRates\Models\TaxRate;
use FI\Modules\Workorders\Support\WorkorderTemplates;
use FI\Support\DashboardWidgets;
use FI\Support\DateFormatter;
use FI\Support\Languages;
use FI\Support\PDF\PDFFactory;
use FI\Support\Skins;
use FI\Support\Statuses\InvoiceStatuses;
use FI\Support\Statuses\QuoteStatuses;
use FI\Support\Statuses\WorkorderStatuses;
use FI\Support\UpdateChecker;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    public function index()
    {
        try
        {
            Crypt::decrypt(config('fi.mailPassword'));
            session()->forget('error');
        }
        catch (\Exception $e)
        {
            // Do nothing, already done in Config Provider
        }

        return view('settings.index')
            ->with([
                'languages'               => Languages::listLanguages(),
                'dateFormats'             => DateFormatter::dropdownArray(),
                'invoiceTemplates'        => InvoiceTemplates::lists(),
                'workorderTemplates'      => WorkorderTemplates::lists(),
                'quoteTemplates'          => QuoteTemplates::lists(),
                'groups'                  => Group::getList(),
                'taxRates'                => TaxRate::getList(),
                'paymentMethods'          => PaymentMethod::getList(),
                'emailSendMethods'        => MailSettings::listSendMethods(),
                'emailEncryptions'        => MailSettings::listEncryptions(),
                'yesNoArray'              => ['0' => trans('fi.no'), '1' => trans('fi.yes')],
                'timezones'               => array_combine(timezone_identifiers_list(), timezone_identifiers_list()),
                'paperSizes'              => ['letter' => trans('fi.letter'), 'A4' => trans('fi.a4'), 'legal' => trans('fi.legal')],
                'paperOrientations'       => ['portrait' => trans('fi.portrait'), 'landscape' => trans('fi.landscape')],
                'currencies'              => Currency::getList(),
                'exchangeRateModes'       => ['automatic' => trans('fi.automatic'), 'manual' => trans('fi.manual')],
                'pdfDisposition'          => ['inline' => trans('fi.inline'), 'attachment' => trans('fi.attachment')],
                'pdfDrivers'              => PDFFactory::getDrivers(),
                'convertQuoteOptions'     => ['quote' => trans('fi.convert_quote_option1'), 'invoice' => trans('fi.convert_quote_option2')],
                'convertWorkorderOptions' => ['workorder' => trans('fi.convert_workorder_option1'), 'invoice' => trans('fi.convert_workorder_option2')],
                'clientUniqueNameOptions' => ['0' => trans('fi.client_unique_name_option_1'), '1' => trans('fi.client_unique_name_option_2')],
                'dashboardWidgets'        => DashboardWidgets::listsByOrder(),
                'colWidthArray'           => array_combine(range(1, 12), range(1, 12)),
                'displayOrderArray'       => array_combine(range(1, 24), range(1, 24)),
                'merchant'                => config('fi.merchant'),
                'skins'                   => Skins::lists(),
                'resultsPerPage'          => array_combine([10,25,50,100], [10,25,50,100]),
                'amountDecimalOptions'    => ['0' => '0', '2' => '2', '3' => '3', '4' => '4'],
                'roundTaxDecimalOptions'  => ['2' => '2', '3' => '3', '4' => '4'],
                'companyProfiles'         => CompanyProfile::getList(),
                'merchantDrivers'         => MerchantFactory::getDrivers(),
                'invoiceStatuses'         => InvoiceStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')],
                'workorderStatuses'       => WorkorderStatuses::listsAllFlat(),
                'quoteStatuses'           => QuoteStatuses::listsAllFlat(),
                'invoiceWhenDraftOptions' => [0 => trans('fi.keep_invoice_date_as_is'), 1 => trans('fi.change_invoice_date_to_todays_date')],
                'workorderWhenDraftOptions' => [0 => trans('fi.keep_workorder_date_as_is'), 1 => trans('fi.change_workorder_date_to_todays_date')],
                'quoteWhenDraftOptions'   => [0 => trans('fi.keep_quote_date_as_is'), 1 => trans('fi.change_quote_date_to_todays_date')],
                'jquiTheme'               => Setting::jquiThemes(),
            ]);
    }

    public function update(SettingUpdateRequest $request)
    {
        //check if no enableCoreEvent checkboxes checked
        if(! $request->has('enabledCoreEvents')){
            $request['enabledCoreEvents'] = [0];
        };

        //check if no enabledModules checkboxes checked
        if(! $request->has('enabledModules')){
            $request['enabledModules'] = [0];
        };

        Setting::saveByKey('enabledModules', array_sum($request->enabledModules));

        Setting::saveByKey('schedulerEnabledCoreEvents', array_sum($request->enabledCoreEvents));

        Setting::saveByKey('skin', json_encode($request->skin));

        foreach (request('setting') as $key => $value)
        {
            $skipSave = false;

            if ($key == 'mailPassword' and $value)
            {
                $value = Crypt::encrypt($value);
            }
            elseif ($key == 'mailPassword' and !$value)
            {
                $skipSave = true;
            }

            if ($key == 'merchant')
            {
                $value = json_encode($value);
            }

            if (!$skipSave)
            {
                Setting::saveByKey($key, $value);
            }
        }

        Setting::writeEmailTemplates();

        return redirect()->route('settings.index')
            ->with('alertSuccess', trans('fi.settings_successfully_saved'));
    }

    public function updateCheck()
    {
        $updateChecker = new UpdateChecker;

        $updateAvailable = $updateChecker->updateAvailable();
        $currentVersion  = $updateChecker->getCurrentVersion();

        if ($updateAvailable)
        {
            $message = trans('fi.update_available', ['version' => $currentVersion]);
        }
        else
        {
            $message = trans('fi.update_not_available');
        }

        return response()->json(
            [
                'success' => true,
                'message' => $message,
            ], 200
        );
    }

    public function saveTab()
    {
        session(['settingTabId' => request('settingTabId')]);
    }
}