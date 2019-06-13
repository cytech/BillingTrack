<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CompanyProfiles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfileStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return ['company' => trans('bt.company')];
    }

    public function rules()
    {
        return ['company' => 'required|unique:company_profiles,company'];
    }
}
