<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Payments\Requests;

use BT\Support\NumberFormatter;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'client_id'        => trans('bt.client'),
            'paid_at'           => trans('bt.payment_date'),
            'invoice_id'        => trans('bt.invoice'),
            'amount'            => trans('bt.amount'),
            'payment_method_id' => trans('bt.payment_method'),
        ];
    }

    public function prepareForValidation()
    {
        $request = $this->all();

        $request['amount'] = (isset($request['amount'])) ? NumberFormatter::unformat($request['amount']) : null;

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'client_id'         => 'required',
            'paid_at'           => 'required',
            'invoice_id'        => 'required',
            'amount'            => 'required|numeric',
            'payment_method_id' => 'required',
        ];
    }
}
