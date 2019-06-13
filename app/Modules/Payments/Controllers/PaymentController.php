<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Payments\Controllers;

use BT\DataTables\PaymentsDataTable;
use BT\Http\Controllers\Controller;
use BT\Http\Resources\PaymentResource;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\PaymentMethods\Models\PaymentMethod;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\Payments\Requests\PaymentRequest;
use BT\Support\DateFormatter;

class PaymentController extends Controller
{
    public function index(PaymentsDataTable $dataTable)
    {
        return $dataTable->render('payments.index');
    }

    public function test() {

        return PaymentResource::collection(Payment::get());
    }

    public function create()
    {
        $date = DateFormatter::format();
        //if enter-payment
        if (request('invoice_id')) {
            $invoice = Invoice::find(request('invoice_id'));

            return view('payments._modal_enter_payment')
                ->with('invoice_id', request('invoice_id'))
                ->with('invoiceNumber', $invoice->number)
                ->with('balance', $invoice->amount->formatted_numeric_balance)
                ->with('date', $date)
                ->with('paymentMethods', PaymentMethod::getList())
                ->with('client', $invoice->client)
                ->with('customFields', CustomField::forTable('payments')->get())
                ->with('redirectTo', request('redirectTo'));
        } else{
            //id enter-multi-payment
            return view('payments._modal_enter_multi_payment')
                ->with('paymentMethods', PaymentMethod::getList())
                ->with('date', $date)
                ->with('customFields', CustomField::forTable('payments')->get())
                ->with('redirectTo', request('redirectTo'));
        }
    }

    public function store(PaymentRequest $request)
    {
        $input = $request->except('custom', 'email_payment_receipt');

        $input['paid_at'] = DateFormatter::unformat($input['paid_at']);

        $payment = Payment::create($input);

        $payment->custom->update($request->input('custom', []));

        return response()->json(['success' => trans('bt.record_successfully_created')], 200);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);

        return view('payments.form')
            ->with('editMode', true)
            ->with('payment', $payment)
            ->with('paymentMethods', PaymentMethod::getList())
            ->with('invoice', $payment->invoice)
            ->with('customFields', CustomField::forTable('payments')->get());
    }

    public function update(PaymentRequest $request, $id)
    {
        $input = $request->except('custom');

        $input['paid_at'] = DateFormatter::unformat($input['paid_at']);

        $payment = Payment::find($id);
        $payment->fill($input);
        $payment->save();

        $payment->custom->update($request->input('custom', []));

        return redirect()->route('payments.index')
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        Payment::destroy($id);

        return redirect()->route('payments.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Payment::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }
}
