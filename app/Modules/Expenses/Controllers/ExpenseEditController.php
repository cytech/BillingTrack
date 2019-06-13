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

use BT\Http\Controllers\Controller;
use BT\Modules\Categories\Models\Category;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Expenses\Requests\ExpenseRequest;
use BT\Modules\Vendors\Models\Vendor;
use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;
use BT\Traits\ReturnUrl;

class ExpenseEditController extends Controller
{
    use ReturnUrl;

    public function edit($id)
    {
        return view('expenses.form')
            ->with('editMode', true)
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('categories', Category::pluck('name', 'id'))
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('expense', $expense = Expense::defaultQuery()->find($id))
            ->with('customFields', CustomField::forTable('expenses')->get());
    }

    public function update(ExpenseRequest $request, $id)
    {
        $record = request()->except('attachments', 'custom');

        $record['expense_date'] = DateFormatter::unformat($record['expense_date']);
        $record['amount'] = NumberFormatter::unformat($record['amount']);
        $record['tax'] = ($record['tax']) ? NumberFormatter::unformat($record['tax']) : 0;

        $expense = Expense::find($id);

        $expense->fill($record);

        $expense->save();

        $expense->custom->update(request('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_updated'));
    }
}
