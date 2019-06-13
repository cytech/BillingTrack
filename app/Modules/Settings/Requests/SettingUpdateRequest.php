<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Settings\Requests;

use BT\Modules\Settings\Rules\ValidFile;
use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'setting.invoicesDueAfter'  => trans('bt.invoices_due_after'),
            'setting.quotesExpireAfter' => trans('bt.quotes_expire_after'),
            'setting.workordersExpireAfter' => trans('bt.workorders_expire_after'),
            'setting.pdfBinaryPath'     => trans('bt.binary_path'),
        ];
    }

    public function rules()
    {
        $rules = [
            'setting.invoicesDueAfter'  => 'required|numeric',
            'setting.quotesExpireAfter' => 'required|numeric',
            'setting.workordersExpireAfter' => 'required|numeric',
            'setting.pdfBinaryPath'     => ['required_if:setting.pdfDriver,wkhtmltopdf', new ValidFile],
        ];

        foreach (config('bt.settingValidationRules') as $settingValidationRules)
        {
            $rules = array_merge($rules, $settingValidationRules['rules']);
        }

        return $rules;
    }
}
