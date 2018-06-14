<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\TimeTracking\Validators;

use Illuminate\Support\Facades\Validator;

class ProjectValidator
{
    private function getAttributeNames()
    {
        return [
            'company_profile_id' => trans('fi.company_profile'),
            'client_name'        => trans('fi.client'),
            'name'               => trans('TimeTracking::lang.project_name'),
            'hourly_rate'        => trans('TimeTracking::lang.hourly_rate'),
            'due_at'             => trans('fi.due_date'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'company_profile_id' => 'required',
            'client_name'        => 'required',
            'name'               => 'required',
            'hourly_rate'        => 'required|numeric',
            'due_at'             => 'required|date',
        ])->setAttributeNames($this->getAttributeNames());
    }

}