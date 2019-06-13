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

namespace BT\Modules\Employees\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
	protected $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
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
			$this->rules['number'] = 'required|integer|unique:employees,number,'.$this->id;
			return $this->rules;
	}

	public function messages()
	{
		return [
			'number.required' => trans('bt.emp_number_required'),
			'number.integer' => trans('bt.emp_number_integer'),
			'number.unique' => trans('bt.emp_number_unique'),
		];
	}

}
