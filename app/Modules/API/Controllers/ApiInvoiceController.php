<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Controllers;

use BT\Events\InvoiceModified;
use BT\Modules\API\Requests\APIInvoiceStoreRequest;
use BT\Modules\API\Requests\APIInvoiceItemRequest;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Invoices\Models\InvoiceItem;
use BT\Modules\Users\Models\User;

class ApiInvoiceController extends ApiController
{
    public function lists()
    {
        $invoices = Invoice::select('invoices.*')
            ->with(['items.amount', 'client', 'amount', 'currency'])
            ->status(request('status'))
            //->sortable(['invoice_date' => 'desc', 'LENGTH(number)' => 'desc', 'number' => 'desc'])
            ->paginate(config('bt.resultsPerPage'));

        return response()->json($invoices);
    }

    public function show()
    {
        return response()->json(Invoice::with(['items.amount', 'client', 'amount', 'currency'])->find(request('id')));
    }

    public function store(APIInvoiceStoreRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        $input['user_id'] = User::where('client_id', 0)->where('api_public_key', $request->input('key'))->first()->id;

        $input['client_id'] = Client::firstOrCreateByUniqueName($request->input('client_name'))->id;

        unset($input['client_name']);

        return response()->json(Invoice::create($input));
    }

    public function addItem(APIInvoiceItemRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        InvoiceItem::create($input);
        $invoice = Invoice::find(request('invoice_id'));
        event(new InvoiceModified($invoice));
    }

    public function delete()
    {
        $validator = $this->validator->make(['id' => request('id')], ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if (Invoice::find(request('id')))
        {
            Invoice::destroy(request('id'));

            return response(200);
        }

        return response()->json([trans('bt.record_not_found')], 400);
    }
}
