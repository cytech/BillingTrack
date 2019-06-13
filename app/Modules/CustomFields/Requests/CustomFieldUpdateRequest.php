<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CustomFields\Requests;

class CustomFieldUpdateRequest extends CustomFieldStoreRequest
{
    public function rules()
    {
        return [
            'field_label' => 'required',
            'field_type'  => 'required',
        ];
    }
}
