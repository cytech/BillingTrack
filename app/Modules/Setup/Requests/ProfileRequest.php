<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Setup\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'user.name'               => trans('bt.name'),
            'user.email'              => trans('bt.email'),
            'user.password'           => trans('bt.password'),
            'company_profile.company' => trans('bt.company_profile'),
        ];
    }

    public function rules()
    {
        return [
            'user.name'               => 'required',
            'user.email'              => 'required|email',
            'user.password'           => 'required|confirmed',
            'company_profile.company' => 'required',
        ];
    }
}
