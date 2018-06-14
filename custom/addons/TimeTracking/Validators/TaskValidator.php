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

class TaskValidator
{
    private function getAttributeNames()
    {
        return [
            'name' => trans('TimeTracking::lang.task'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'time_tracking_project_id' => 'required',
            'name'                     => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

}