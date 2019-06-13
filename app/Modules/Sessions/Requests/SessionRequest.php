<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Sessions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'email'    => trans('fi.email'),
            'password' => trans('fi.password'),
        ];
    }

    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }
}
