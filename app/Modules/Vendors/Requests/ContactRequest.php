<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Vendors\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'  => trans('bt.name'),
            'email' => trans('bt.email'),
        ];
    }

    public function rules()
    {
        return [
            'name'  => 'required',
            'email' => 'required|email',
        ];
    }
}
