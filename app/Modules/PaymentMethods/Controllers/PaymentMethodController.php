<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\PaymentMethods\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\PaymentMethods\Models\PaymentMethod;
use BT\Modules\PaymentMethods\Requests\PaymentMethodRequest;
use BT\Traits\ReturnUrl;

class PaymentMethodController extends Controller
{
    use ReturnUrl;

    public function index()
    {
        $this->setReturnUrl();

        $paymentMethods = PaymentMethod::sortable(['name' => 'asc'])->paginate(config('bt.resultsPerPage'));

        return view('payment_methods.index')
            ->with('paymentMethods', $paymentMethods);
    }

    public function create()
    {
        return view('payment_methods.form')
            ->with('editMode', false);
    }

    public function store(PaymentMethodRequest $request)
    {
        PaymentMethod::create($request->all());

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('bt.record_successfully_created'));
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        return view('payment_methods.form')
            ->with(['editMode' => true, 'paymentMethod' => $paymentMethod]);
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        $paymentMethod->fill($request->all());

        $paymentMethod->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($id)
    {
        PaymentMethod::destroy($id);

        return redirect()->route('paymentMethods.index')
            ->with('alert', trans('bt.record_successfully_deleted'));
    }
}
