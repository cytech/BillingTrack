<?php
/**
 * *
 *  * This file is part of BillingTrack.
 *  *
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *  
 *
 */

namespace BT\Modules\Scheduler\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
	protected $rules = [
		'start' => 'required|date_format:Y-m-d H:i',
		'end'   => 'required|date_format:Y-m-d H:i|after:start',
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
        if ( $this->method() == 'POST' ) {
            return $this->rules;
        } else {
            return [];
        }
	}

}
