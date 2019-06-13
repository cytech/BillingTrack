<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Expenses\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseBillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'invoice_id' => trans('bt.invoice'),
            'item_name'  => trans('bt.item'),
        ];
    }

    public function rules()
    {
        return [
            'invoice_id' => 'required',
            'item_name'  => 'required',
        ];
    }
}
