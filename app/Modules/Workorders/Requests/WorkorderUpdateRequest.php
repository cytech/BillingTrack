<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Requests;

use BT\Support\NumberFormatter;

class WorkorderUpdateRequest extends WorkorderStoreRequest
{
    public function prepareForValidation()
    {
        $request = $this->all();

        if (isset($request['items']))
        {
            foreach ($request['items'] as $key => $item)
            {
                $request['items'][$key]['quantity'] = NumberFormatter::unformat($item['quantity']);
                $request['items'][$key]['price']    = NumberFormatter::unformat($item['price']);
            }
        }

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'summary'          => 'max:500',
            'workorder_date'  => 'required',
            'number'           => 'required',
            'workorder_status_id' => 'required',
            'exchange_rate'    => 'required|numeric',
            'template'         => 'required',
            'items.*.name'     => 'required_with:items.*.price,items.*.quantity',
            'items.*.quantity' => 'required_with:items.*.price,items.*.name|numeric',
            'items.*.price'    => 'required_with:items.*.name,items.*.quantity|numeric',
            'expires_at'      => 'required',
            'job_date'        => 'required',
            'start_time'        => 'required',
            'end_time'        => 'required|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required'  => 'Start Time is required',
            'end_time.required'  => 'End Time is required',
            'end_time.after'  => 'End Time must be greater than Start Time',
        ];
    }
}
