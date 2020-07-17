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

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Groups\Models\Group;
use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Modules\RecurringInvoices\Requests\RecurringInvoiceStoreRequest;
use BT\Support\DateFormatter;
use BT\Support\Frequency;

class RecurringInvoiceCreateController extends Controller
{
    public function create()
    {
        return view('recurring_invoices._modal_create')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('groups', Group::getList())
            ->with('frequencies', Frequency::lists());
    }

    public function store(RecurringInvoiceStoreRequest $request)
    {
        $input = $request->except('client_name');
        $input['client_id'] = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;
        $input['next_date'] = DateFormatter::unformat($input['next_date']);
        $input['stop_date'] = ($input['stop_date']) ? DateFormatter::unformat($input['stop_date']) : '0000-00-00';

        $recurringInvoice = RecurringInvoice::create($input);

        return response()->json(['success' => true, 'url' => route('recurringInvoices.edit', [$recurringInvoice->id])], 200);
    }
}
