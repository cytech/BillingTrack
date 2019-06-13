<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Groups\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'     => trans('bt.name'),
            'next_id'  => trans('bt.next_number'),
            'left_pad' => trans('bt.left_pad'),
            'format'   => trans('bt.format'),
        ];
    }

    public function rules()
    {
        return [
            'name'     => 'required',
            'next_id'  => 'required|integer',
            'left_pad' => 'required|numeric',
            'format'   => 'required',
        ];
    }
}
