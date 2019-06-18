<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Settings\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\MailQueue\Support\MailSettings;
use BT\Modules\Merchant\Support\MerchantFactory;
use BT\Modules\PaymentMethods\Models\PaymentMethod;
use BT\Modules\Purchaseorders\Support\PurchaseorderTemplates;
use BT\Modules\Quotes\Support\QuoteTemplates;
use BT\Modules\Settings\Models\Setting;
use BT\Modules\Settings\Requests\SettingUpdateRequest;
use BT\Modules\TaxRates\Models\TaxRate;
use BT\Modules\Workorders\Support\WorkorderTemplates;
use BT\Support\DashboardWidgets;
use BT\Support\DateFormatter;
use BT\Support\Languages;
use BT\Support\PDF\PDFFactory;
use BT\Support\Skins;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Support\Statuses\PurchaseorderStatuses;
use BT\Support\Statuses\QuoteStatuses;
use BT\Support\Statuses\WorkorderStatuses;
use BT\Support\UpdateChecker;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    public function index()
    {
        try
        {
            Crypt::decrypt(config('bt.mailPassword'));
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
                'purchaseorderTemplates'  => PurchaseorderTemplates::lists(),
                'workorderTemplates'      => WorkorderTemplates::lists(),
                'quoteTemplates'          => QuoteTemplates::lists(),
                'groups'                  => Group::getList(),
                'taxRates'                => TaxRate::getList(),
                'paymentMethods'          => PaymentMethod::getList(),
                'emailSendMethods'        => MailSettings::listSendMethods(),
                'emailEncryptions'        => MailSettings::listEncryptions(),
                'yesNoArray'              => ['0' => trans('bt.no'), '1' => trans('bt.yes')],
                'timezones'               => array_combine(timezone_identifiers_list(), timezone_identifiers_list()),
                'paperSizes'              => ['letter' => trans('bt.letter'), 'A4' => trans('bt.a4'), 'legal' => trans('bt.legal')],
                'paperOrientations'       => ['portrait' => trans('bt.portrait'), 'landscape' => trans('bt.landscape')],
                'currencies'              => Currency::getList(),
                'exchangeRateModes'       => ['automatic' => trans('bt.automatic'), 'manual' => trans('bt.manual')],
                'pdfDisposition'          => ['inline' => trans('bt.inline'), 'attachment' => trans('bt.attachment')],
                'pdfDrivers'              => PDFFactory::getDrivers(),
                'convertQuoteOptions'     => ['quote' => trans('bt.convert_quote_option1'), 'invoice' => trans('bt.convert_quote_option2')],
                'convertWorkorderOptions' => ['workorder' => trans('bt.convert_workorder_option1'), 'invoice' => trans('bt.convert_workorder_option2')],
                'convertWorkorderDate'    => ['jobdate' => trans('bt.convert_workorder_date1'), 'currentdate' => trans('bt.convert_workorder_date2')],
                'clientUniqueNameOptions' => ['0' => trans('bt.client_unique_name_option_1'), '1' => trans('bt.client_unique_name_option_2')],
                'dashboardWidgets'        => DashboardWidgets::listsByOrder(),
                'colWidthArray'           => array_combine(range(1, 12), range(1, 12)),
                'displayOrderArray'       => array_combine(range(1, 24), range(1, 24)),
                'merchant'                => config('bt.merchant'),
                'skins'                   => Skins::lists(),
                'resultsPerPage'          => array_combine([10,25,50,100], [10,25,50,100]),
                'amountDecimalOptions'    => ['0' => '0', '2' => '2', '3' => '3', '4' => '4'],
                'roundTaxDecimalOptions'  => ['2' => '2', '3' => '3', '4' => '4'],
                'companyProfiles'         => CompanyProfile::getList(),
                'merchantDrivers'         => MerchantFactory::getDrivers(),
                'invoiceStatuses'         => InvoiceStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')],
                'purchaseorderStatuses'   => PurchaseorderStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')],
                'workorderStatuses'       => WorkorderStatuses::listsAllFlat(),
                'quoteStatuses'           => QuoteStatuses::listsAllFlat(),
                'invoiceWhenDraftOptions' => [0 => trans('bt.keep_invoice_date_as_is'), 1 => trans('bt.change_invoice_date_to_todays_date')],
                'purchaseorderWhenDraftOptions' => [0 => trans('bt.keep_purchaseorder_date_as_is'), 1 => trans('bt.change_purchaseorder_date_to_todays_date')],
                'workorderWhenDraftOptions' => [0 => trans('bt.keep_workorder_date_as_is'), 1 => trans('bt.change_workorder_date_to_todays_date')],
                'quoteWhenDraftOptions'   => [0 => trans('bt.keep_quote_date_as_is'), 1 => trans('bt.change_quote_date_to_todays_date')],
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
            ->with('alertSuccess', trans('bt.settings_successfully_saved'));
    }

    public function updateCheck()
    {
        $updateChecker = new UpdateChecker;

        $updateAvailable = $updateChecker->updateAvailable();
        $currentVersion  = $updateChecker->getCurrentVersion();

        if ($updateAvailable)
        {
            $message = trans('bt.update_available', ['version' => $currentVersion]);
        }
        else
        {
            $message = trans('bt.update_not_available');
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
