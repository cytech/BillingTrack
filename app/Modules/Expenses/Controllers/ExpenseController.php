<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Expenses\Controllers;

use BT\DataTables\ExpensesDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Categories\Models\Category;
use BT\Modules\Vendors\Models\Vendor;
use BT\Traits\ReturnUrl;

class ExpenseController extends Controller
{
    use ReturnUrl;

    public function index(ExpensesDataTable $dataTable)
    {
        $this->setReturnUrl();
        $status = request('status');
        $categories = ['' => trans('bt.all_categories')] + Category::getList();
        $vendors = ['' => trans('bt.all_vendors')] + Vendor::getList();
        $statuses = ['' => trans('bt.all_statuses'), 'billed' => trans('bt.billed'), 'not_billed' => trans('bt.not_billed'), 'not_billable' => trans('bt.not_billable')];
        $companyProfiles = ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('expenses.index', compact('status', 'categories', 'vendors', 'statuses', 'companyProfiles'));

    }

    public function delete($id)
    {
        Expense::destroy($id);

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_deleted'));
    }

    public function bulkDelete()
    {
        Expense::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);

    }
}
