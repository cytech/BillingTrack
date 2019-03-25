<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TimeTracking\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'start_at' => trans('fi.start_at'),
            'end_at'   => trans('fi.end_at'),
        ];
    }


    public function rules()
    {
        return [
            'start_at' => 'required',
            'end_at'   => 'required',
        ];
    }
}
