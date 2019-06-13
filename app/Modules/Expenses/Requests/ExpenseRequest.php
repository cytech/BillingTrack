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

use BT\Support\NumberFormatter;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'user_id'            => trans('bt.user'),
            'company_profile_id' => trans('bt.company_profile'),
            'expense_date'       => trans('bt.date'),
            'category_name'      => trans('bt.category'),
            'description'        => trans('bt.description'),
            'amount'             => trans('bt.amount'),
        ];
    }

    public function prepareForValidation()
    {
        $request = $this->all();

        if (isset($request['amount']))
        {
            $request['amount'] = NumberFormatter::unformat($request['amount']);
        }

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'user_id'            => 'required',
            'company_profile_id' => 'required',
            'expense_date'       => 'required',
            'category_name'      => 'required',
            'description'        => 'max:255',
            'amount'             => 'required|numeric',
        ];
    }
}
