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

use Illuminate\Foundation\Http\FormRequest;

class CustomFieldStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'tbl_name'    => trans('bt.table_name'),
            'field_label' => trans('bt.field_label'),
            'field_type'  => trans('bt.field_type'),
        ];
    }

    public function rules()
    {
        return [
            'tbl_name'    => 'required',
            'field_label' => 'required',
            'field_type'  => 'required',
        ];
    }
}
