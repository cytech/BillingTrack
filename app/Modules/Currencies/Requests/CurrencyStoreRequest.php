<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Currencies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'      => trans('bt.name'),
            'code'      => trans('bt.code'),
            'symbol'    => trans('bt.symbol'),
            'placement' => trans('bt.symbol_placement'),
        ];
    }

    public function rules()
    {
        return [
            'name'      => 'required',
            'code'      => 'required|unique:currencies',
            'symbol'    => 'required',
            'placement' => 'required',
        ];
    }
}
