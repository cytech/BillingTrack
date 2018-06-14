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

class TimerValidator
{
    private function getAttributeNames()
    {
        return [
            'start_at' => trans('fi.start_at'),
            'end_at'   => trans('fi.end_at'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'start_at' => 'required',
            'end_at'   => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

}