<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Invoices\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
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
            'invoice_date'       => trans('bt.date'),
            'due_at'             => trans('bt.due'),
            'number'             => trans('bt.invoice_number'),
            'invoice_status_id'  => trans('bt.status'),
            'exchange_rate'      => trans('bt.exchange_rate'),
            'template'           => trans('bt.template'),
            'group_id'           => trans('bt.group'),
            'items.*.name'       => trans('bt.name'),
            'items.*.quantity'   => trans('bt.quantity'),
            'items.*.price'      => trans('bt.price'),
        ];
    }

    public function rules()
    {
        return [
            'company_profile_id' => 'required|integer|exists:company_profiles,id',
            'client_name'        => 'required',
            'invoice_date'       => 'required',
            'user_id'            => 'required',
        ];
    }
}
