<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\RecurringInvoices\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecurringInvoiceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'company_profile_id'  => trans('bt.company_profile'),
            'client_name'         => trans('bt.client'),
            'user_id'             => trans('bt.user'),
            'next_date'           => trans('bt.start_date'),
            'recurring_frequency' => trans('bt.frequency'),
            'recurring_period'    => trans('bt.frequency'),
            'summary'             => trans('bt.summary'),
            'exchange_rate'       => trans('bt.exchange_rate'),
            'template'            => trans('bt.template'),
            'client_id'           => trans('bt.client'),
            'group_id'            => trans('bt.group'),
            'stop_date'           => trans('bt.stop_date'),
            'items.*.name'        => trans('bt.name'),
            'items.*.quantity'    => trans('bt.quantity'),
            'items.*.price'       => trans('bt.price'),
        ];
    }

    public function rules()
    {
        return [
            'company_profile_id'  => 'required',
            'client_name'         => 'required',
            'user_id'             => 'required',
            'next_date'           => 'required',
            'recurring_frequency' => 'numeric|required',
            'recurring_period'    => 'required',
        ];
    }
}
