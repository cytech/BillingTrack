<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\API\Requests;

use BT\Support\NumberFormatter;
use Illuminate\Foundation\Http\FormRequest;

class APIInvoiceItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'     => trans('bt.name'),
            'quantity' => trans('bt.quantity'),
            'price'    => trans('bt.price'),
        ];
    }

    public function prepareForValidation()
    {
        $request = $this->all();

        $request['quantity'] = NumberFormatter::unformat($request['quantity']);
        $request['price']    = NumberFormatter::unformat($request['price']);

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'invoice_id' => 'required',
            'name'       => 'required_with:price,quantity',
            'quantity'   => 'required_with:price,name|numeric',
            'price'      => 'required_with:name,quantity|numeric',
        ];
    }
}
