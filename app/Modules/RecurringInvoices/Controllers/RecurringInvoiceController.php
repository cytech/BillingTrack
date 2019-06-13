<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\RecurringInvoices\Controllers;

use BT\DataTables\RecurringInvoicesDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Support\Frequency;
use BT\Traits\ReturnUrl;

class RecurringInvoiceController extends Controller
{
    use ReturnUrl;

    public function index(RecurringInvoicesDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');
        $statuses = ['all_statuses' => trans('bt.all_statuses'), 'active' => trans('bt.active'), 'inactive' => trans('bt.inactive')];
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();
        $frequencies = Frequency::lists();

        return $dataTable->render('recurring_invoices.index', compact('status','statuses', 'frequencies', 'companyProfiles'));
    }

    public function bulkDelete()
    {
        RecurringInvoice::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function delete($id)
    {
        RecurringInvoice::destroy($id);

        return redirect()->route('recurringInvoices.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }
}
