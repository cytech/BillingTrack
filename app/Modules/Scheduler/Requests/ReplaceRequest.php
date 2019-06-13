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

class ReplaceRequest extends FormRequest
{

	protected $rules = [
	    'id' => 'required',
        'resource_id' => 'required|integer|min:1',
        'name' => 'required',
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

	    return $this->rules;

	}

	public function messages()
	{
		return [
			'resource_id.required' => 'A valid Employee ID is required',
            'resource_id.min' => 'There are no available Employees for this date',

		];
	}
}
