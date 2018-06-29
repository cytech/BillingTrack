<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 * 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Expenses\Controllers;

use FI\DataTables\ExpensesDataTable;
use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Expenses\Models\ExpenseCategory;
use FI\Modules\Expenses\Models\ExpenseVendor;
use FI\Traits\ReturnUrl;

class ExpenseController extends Controller
{
    use ReturnUrl;

    public function index(ExpensesDataTable $dataTable)
    {
        $this->setReturnUrl();
        $status = request('status');
        $categories = ['' => trans('fi.all_categories')] + ExpenseCategory::getList();
        $vendors = ['' => trans('fi.all_vendors')] + ExpenseVendor::getList();
        $statuses = ['' => trans('fi.all_statuses'), 'billed' => trans('fi.billed'), 'not_billed' => trans('fi.not_billed'), 'not_billable' => trans('fi.not_billable')];
        $companyProfiles = ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList();

        return $dataTable->render('expenses.index', compact('status', 'categories', 'vendors', 'statuses', 'companyProfiles'));

    }

    public function delete($id)
    {
        Expense::destroy($id);

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('fi.record_successfully_deleted'));
    }

    public function bulkDelete()
    {
        Expense::destroy(request('ids'));
    }
}