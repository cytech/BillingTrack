<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TaxRates\Requests;

use BT\Support\NumberFormatter;
use Illuminate\Foundation\Http\FormRequest;

class TaxRateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'    => trans('bt.name'),
            'percent' => trans('bt.percent'),
        ];
    }

    public function prepareForValidation()
    {
        $request = $this->all();

        $request['percent'] = NumberFormatter::unformat($request['percent']);

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'name'    => 'required',
            'percent' => 'required|numeric',
        ];
    }
}
