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

use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\Payments\Requests\PaymentRequest;

class ApiPaymentController extends ApiController
{
    public function lists()
    {
        $payments = Payment::select('payments.*')
            ->leftJoin('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
            ->clientId(request('client_id'))
            ->invoiceId(request('invoice_id'))
            ->invoiceNumber(request('invoice_number'))
            //->sortable(['paid_at' => 'desc', 'payments.created_at' => 'desc'])
            ->paginate(config('bt.resultsPerPage'));

        return response()->json($payments);
    }

    public function show()
    {
        return response()->json(Payment::find(request('id')));
    }

    public function store(PaymentRequest $request)
    {
        $input = $request->except('key', 'signature', 'timestamp', 'endpoint');

        if (!Invoice::find($input['invoice_id']))
        {
            return response()->json([trans('bt.record_not_found')], 400);
        }

        $payment = Payment::create($input);

        return response()->json($payment);
    }

    public function delete()
    {
        $validator = $this->validator->make(request()->only(['id']), ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if (Payment::find(request('id')))
        {
            Payment::destroy(request('id'));

            return response(200);
        }

        return response()->json([trans('bt.record_not_found')], 400);
    }
}
