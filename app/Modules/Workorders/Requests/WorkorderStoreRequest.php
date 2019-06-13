<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Workorders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkorderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'company_profile_id' => trans('bt.company_profile'),
            'client_name'        => trans('bt.client'),
            'client_id'          => trans('bt.client'),
            'user_id'            => trans('bt.user'),
            'summary'            => trans('bt.summary'),
            'workorder_date'     => trans('bt.date'),
            'due_at'             => trans('bt.due'),
            'number'             => trans('bt.invoice_number'),
            'workorder_status_id'    => trans('bt.status'),
            'exchange_rate'      => trans('bt.exchange_rate'),
            'template'           => trans('bt.template'),
            'group_id'           => trans('bt.group'),
            'items.*.name'       => trans('bt.name'),
            'items.*.quantity'   => trans('bt.quantity'),
            'items.*.price'      => trans('bt.price'),
            'expires_at'         => trans('bt.expires'),
            'job_date'           => trans('bt.job_date'),
            'start_time'         => trans('bt.start_time'),
            'end_time'           => trans('bt.end_time'),
        ];
    }

    public function rules()
    {
        return [
            'company_profile_id' => 'required|integer|exists:company_profiles,id',
            'client_name'        => 'required',
            'workorder_date'     => 'required',
            'user_id'            => 'required',
            'start_time'        => 'required|sometimes',
            'end_time'        => 'required|sometimes|after:start_time',
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
