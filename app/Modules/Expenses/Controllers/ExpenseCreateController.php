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
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Expenses\Models\Expense;
use BT\Modules\Expenses\Requests\ExpenseRequest;
use BT\Modules\Vendors\Models\Vendor;
use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;
use BT\Traits\ReturnUrl;

class ExpenseCreateController extends Controller
{
    use ReturnUrl;

    public function create()
    {
        return view('expenses.form')
            ->with('editMode', false)
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('categories', Category::pluck('name', 'id'))
            ->with('vendors', Vendor::pluck('name', 'id'))
            ->with('currentDate', DateFormatter::format(date('Y-m-d')))
            ->with('customFields', CustomField::forTable('expenses')->get());
    }

    public function store(ExpenseRequest $request)
    {
        $record = request()->except('attachments', 'custom');

        $record['expense_date'] = DateFormatter::unformat($record['expense_date']);
        $record['amount'] = NumberFormatter::unformat($record['amount']);
        $record['tax'] = ($record['tax']) ? NumberFormatter::unformat($record['tax']) : 0;

        $record['category_id'] = Category::firstOrCreate(['name' => $request->category_name])->id;

        if ($request->vendor_name) {
            $record['vendor_id'] = Vendor::firstOrCreate(['name' => $request->vendor_name])->id;
        } else {
            $record['vendor_id'] = 0;
        }

        if ($request->client_name) {
            $record['client_id'] = Client::firstOrCreateByUniqueName($request->client_name)->id;
        } else {
            $record['client_id'] = 0;
        }

        $expense = Expense::create($record);

        $expense->custom->update(request('custom', []));

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }
}
