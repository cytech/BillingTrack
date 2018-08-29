<?php
/**
 * *
 *  * This file is part of Workorder Addon for FusionInvoice.
 *  *
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *  
 *
 */

namespace FI\Modules\Employees\Requests;

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
			'number.required' => trans('fi.emp_number_required'),
			'number.integer' => trans('fi.emp_number_integer'),
			'number.unique' => trans('fi.emp_number_unique'),
		];
	}

}
