<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 * 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Controllers;

use FI\DataTables\RecurringInvoicesDataTable;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Support\Frequency;
use FI\Traits\ReturnUrl;

class RecurringInvoiceController extends Controller
{
    use ReturnUrl;

    public function index(RecurringInvoicesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = ['all_statuses' => trans('fi.all_statuses'), 'active' => trans('fi.active'), 'inactive' => trans('fi.inactive')];
        $companyProfiles = ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList();
        $frequencies = Frequency::lists();

        return $dataTable->render('recurring_invoices.index', compact('status','statuses', 'frequencies', 'companyProfiles'));
    }

    public function bulkDelete()
    {
        RecurringInvoice::destroy(request('ids'));
    }

    public function delete($id)
    {
        RecurringInvoice::destroy($id);

        return redirect()->route('recurringInvoices.index')
            ->with('alert', trans('fi.record_successfully_trashed'));
    }
}