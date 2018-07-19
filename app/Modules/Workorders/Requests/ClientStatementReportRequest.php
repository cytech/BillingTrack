<?php
/**
 * *
 *  * This file is part of Workorder Addon for FusionInvoice.
 *  * (c) Cytech <cytech@cytech-eng.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *  
 *
 */

namespace Addons\Workorders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStatementReportRequest extends FormRequest
{
	public function authorize()
	{
		return true;//return $this->user();//->can('create', 'schedule');
	}

    public function attributes()
    {
        return [
            'from_date'   => trans('fi.from_date'),
            'to_date'     => trans('fi.to_date'),
            'client_name' => trans('fi.client'),
        ];
    }

    public function rules()
    {
        return [
            'from_date'   => 'required',
            'to_date'     => 'required',
            'client_name' => 'required|exists:clients,unique_name',
        ];
	}
}