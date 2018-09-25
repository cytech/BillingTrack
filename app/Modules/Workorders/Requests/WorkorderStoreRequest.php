<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Workorders\Requests;

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
            'company_profile_id' => trans('fi.company_profile'),
            'client_name'        => trans('fi.client'),
            'client_id'          => trans('fi.client'),
            'user_id'            => trans('fi.user'),
            'summary'            => trans('fi.summary'),
            'workorder_date'     => trans('fi.date'),
            'due_at'             => trans('fi.due'),
            'number'             => trans('fi.invoice_number'),
            'workorder_status_id'    => trans('fi.status'),
            'exchange_rate'      => trans('fi.exchange_rate'),
            'template'           => trans('fi.template'),
            'group_id'           => trans('fi.group'),
            'items.*.name'       => trans('fi.name'),
            'items.*.quantity'   => trans('fi.quantity'),
            'items.*.price'      => trans('fi.price'),
            'expires_at'         => trans('fi.expires'),
            'job_date'           => trans('fi.job_date'),
            'start_time'         => trans('fi.start_time'),
            'end_time'           => trans('fi.end_time'),
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