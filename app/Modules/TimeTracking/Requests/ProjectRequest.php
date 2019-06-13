<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TimeTracking\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'company_profile_id' => trans('fi.company_profile'),
            'client_name'        => trans('fi.client'),
            'name'               => trans('fi.project_name'),
            'hourly_rate'        => trans('fi.hourly_rate'),
            'due_at'             => trans('fi.due_date'),
        ];
    }


    public function rules()
    {
        return [
            'company_profile_id' => 'required',
            'client_name'        => 'required',
            'name'               => 'required',
            'hourly_rate'        => 'required|numeric',
            'due_at'             => 'required|date',
        ];
    }
}
