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

class CategoryRequest extends FormRequest
{

	protected $rules = [
		'name'      => 'required',
		'text_color' => 'required',
		'bg_color'   => 'required',
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

}
