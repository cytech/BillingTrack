<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CompanyProfiles\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\CompanyProfiles\Requests\CompanyProfileStoreRequest;
use BT\Modules\CompanyProfiles\Requests\CompanyProfileUpdateRequest;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Invoices\Support\InvoiceTemplates;
use BT\Modules\Purchaseorders\Support\PurchaseorderTemplates;
use BT\Modules\Quotes\Support\QuoteTemplates;
use BT\Modules\Workorders\Support\WorkorderTemplates;
use BT\Support\Languages;
use BT\Traits\ReturnUrl;

class CompanyProfileController extends Controller
{
    use ReturnUrl;

    public function index()
    {
        $this->setReturnUrl();

        return view('company_profiles.index')
            ->with('companyProfiles', CompanyProfile::orderBy('company')->paginate(config('bt.resultsPerPage')));
    }

    public function create()
    {
        return view('company_profiles.form')
            ->with('editMode', false)
            ->with('invoiceTemplates', InvoiceTemplates::lists())
            ->with('quoteTemplates', QuoteTemplates::lists())
            ->with('workorderTemplates', WorkorderTemplates::lists())
            ->with('purchaseorderTemplates', PurchaseorderTemplates::lists())
            ->with('currencies', Currency::getList())
            ->with('languages', Languages::listLanguages())
            ->with('customFields', CustomField::forTable('company_profiles')->get());
    }

    public function store(CompanyProfileStoreRequest $request)
    {
        $input = $request->except('custom', 'fill_shipping');

        if ($request->hasFile('logo'))
        {
            $logoFileName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(storage_path(), $logoFileName);

            $input['logo'] = $logoFileName;
        }

        $companyProfile = CompanyProfile::create($input);

        $companyProfile->custom->update($request->input('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        $companyProfile = CompanyProfile::find($id);

        return view('company_profiles.form')
            ->with('editMode', true)
            ->with('companyProfile', $companyProfile)
            ->with('companyProfileInUse', CompanyProfile::inUse($id))
            ->with('invoiceTemplates', InvoiceTemplates::lists())
            ->with('quoteTemplates', QuoteTemplates::lists())
            ->with('workorderTemplates', WorkorderTemplates::lists())
            ->with('purchaseorderTemplates', PurchaseorderTemplates::lists())
            ->with('currencies', Currency::getList())
            ->with('languages', Languages::listLanguages())
            ->with('customFields', CustomField::forTable('company_profiles')->get());
    }

    public function update(CompanyProfileUpdateRequest $request, $id)
    {
        $input = $request->except('custom', 'fill_shipping');

        if ($request->hasFile('logo'))
        {
            $logoFileName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(storage_path(), $logoFileName);

            $input['logo'] = $logoFileName;
        }

        $companyProfile = CompanyProfile::find($id);
        $companyProfile->fill($input);
        $companyProfile->save();

        $companyProfile->custom->update($request->input('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        if (CompanyProfile::inUse($id))
        {
            $alert = trans('bt.cannot_delete_record_in_use');
        }
        else
        {
            CompanyProfile::destroy($id);

            $alert = trans('bt.record_successfully_deleted');
        }

        return redirect()->route('companyProfiles.index')
            ->with('alert', $alert);
    }

    public function ajaxModalLookup()
    {
        return view('company_profiles._modal_lookup')
            ->with('id', request('id'))
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('refreshFromRoute', request('refresh_from_route'))
            ->with('updateCompanyProfileRoute', request('update_company_profile_route'));
    }

    public function deleteLogo($id)
    {
        $companyProfile = CompanyProfile::find($id);

        $companyProfile->logo = null;

        $companyProfile->save();

        if (file_exists(storage_path($companyProfile->logo)))
        {
            try
            {
                unlink(storage_path($companyProfile->logo));
            }
            catch (\Exception $e)
            {

            }
        }
    }
}
