<?php


/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

	protected $table = 'products';

//    public function workorderitem()
//    {
//        return $this->belongsTo('Addons\Workorders\Models\WorkorderItem','product_id', 'id')
//            ->where('product_table','=','products');
//    }
}
