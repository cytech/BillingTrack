<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Exports\Support\Results;

use BT\Modules\Expenses\Models\Expense;

class Expenses implements SourceInterface
{
    public function getResults($params = [])
    {
        return Expense::select('expenses.expense_date', 'expenses.description', 'expenses.amount',
            'clients.name AS client_name', 'categories.name AS category_name', 'vendors.name AS vendor_name',
            'invoices.number AS invoice_number', 'users.name AS user_name', 'company_profiles.company')
            ->leftJoin('users', 'users.id', '=', 'expenses.user_id')
            ->leftJoin('categories', 'categories.id', '=', 'expenses.category_id')
            ->leftJoin('clients', 'clients.id', '=', 'expenses.client_id')
            ->leftJoin('vendors', 'vendors.id', '=', 'expenses.vendor_id')
            ->leftJoin('invoices', 'invoices.id', '=', 'expenses.invoice_id')
            ->join('company_profiles', 'company_profiles.id', '=', 'expenses.company_profile_id')
            ->orderBy('invoices.number')
            ->get()
            ->makeHidden(['formatted_description', 'formatted_expense_date', 'formatted_amount', 'is_billable', 'has_been_billed'])
            ->toArray();
    }
}
