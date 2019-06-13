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
use BT\Modules\Vendors\Models\Vendor;

class ExpenseLookupController extends Controller
{
    public function lookupCategory()
    {
        $expenses = Category::select('name')
            ->where('name', 'like', '%' . request('term') . '%')
            ->orderBy('name')
            ->get();

        $list = [];

        foreach ($expenses as $expense)
        {
            $list[]['value'] = $expense->name;
        }

        return json_encode($list);
    }

    public function lookupVendor()
    {
        $expenses = Vendor::select('name')
            ->where('name', 'like', '%' . request('term') . '%')
            ->orderBy('name')
            ->get();

        $list = [];

        foreach ($expenses as $expense)
        {
            $list[]['value'] = $expense->name;
        }

        return json_encode($list);
    }
}
