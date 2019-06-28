<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Purchaseorders\Requests;

use BT\Support\NumberFormatter;

class PurchaseorderUpdateRequest extends PurchaseorderStoreRequest
{
    public function prepareForValidation()
    {
        $request = $this->all();

        if (isset($request['items']))
        {
            foreach ($request['items'] as $key => $item)
            {
                $request['items'][$key]['quantity'] = NumberFormatter::unformat($item['quantity']);
                $request['items'][$key]['cost']    = NumberFormatter::unformat($item['cost']);
            }
        }

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'summary'           => 'max:255',
            'purchaseorder_date'      => 'required',
            'due_at'            => 'required',
            'number'            => 'required',
            'purchaseorder_status_id' => 'required',
            'exchange_rate'     => 'required|numeric',
            'template'          => 'required',
            'items.*.name'      => 'required_with:items.*.cost,items.*.quantity|distinct',
            'items.*.quantity'  => 'required_with:items.*.cost,items.*.name|numeric',
            'items.*.cost'     => 'required_with:items.*.name,items.*.quantity|numeric',
        ];
    }

    public function messages(){
        return [
            'items.*.name.distinct' => 'Duplicate items detected. Please combine'
        ];
    }
}
