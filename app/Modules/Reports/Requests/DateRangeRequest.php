<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateRangeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'from_date' => trans('bt.from_date'),
            'to_date'   => trans('bt.to_date'),
        ];
    }

    public function rules()
    {
        return [
            'from_date' => 'required',
            'to_date'   => 'required',
        ];
    }
}
