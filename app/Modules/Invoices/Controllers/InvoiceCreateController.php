<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Modules\Groups\Models\Group;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Requests\InvoiceStoreRequest;
use BT\Support\DateFormatter;

class InvoiceCreateController extends Controller
{
    public function create()
    {
        return view('invoices._modal_create')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('groups', Group::getList());
    }

    public function store(InvoiceStoreRequest $request)
    {
        $input = $request->except('client_name');

        $input['client_id']    = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;
        $input['invoice_date'] = DateFormatter::unformat($input['invoice_date']);

        $invoice = Invoice::create($input);

        return response()->json(['id' => $invoice->id], 200);
    }
}
