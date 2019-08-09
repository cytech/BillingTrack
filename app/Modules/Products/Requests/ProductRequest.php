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

namespace BT\Modules\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
	protected $rules = [
        'price' => 'numeric',
        'cost' => 'numeric',
		'numstock' => 'numeric',
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
            'numstock.numeric' => "The ".trans('bt.product_numstock')." must be a number.",
        ];
    }
}
