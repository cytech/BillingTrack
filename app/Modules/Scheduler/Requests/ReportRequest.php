<?php
/**
 * *
 *  * This file is part of FusionInvoiceFOSS.
 *  *
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *  
 *
 */

namespace FI\Modules\Scheduler\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
	protected $rules = [
		'start_date' => 'required|date_format:Y-m-d H:i',
		'end_date'   => 'required|date_format:Y-m-d H:i|after:start_date',
	];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	public function rules() {
			return [];
	}

}
