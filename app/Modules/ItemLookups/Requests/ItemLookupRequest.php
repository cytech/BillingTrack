<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ItemLookups\Requests;

use BT\Support\NumberFormatter;
use Illuminate\Foundation\Http\FormRequest;

class ItemLookupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'  => trans('bt.name'),
            'price' => trans('bt.price'),
        ];
    }

    public function prepareForValidation()
    {
        $request = $this->all();

        $request['price'] = NumberFormatter::unformat($request['price']);

        $this->replace($request);
    }

    public function rules()
    {
        return [
            'name'  => 'required',
            'price' => 'required|numeric',
        ];
    }
}
