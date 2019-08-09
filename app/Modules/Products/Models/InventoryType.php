<?php


/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Products\Models;


use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    public $timestamps = false;

    protected $guarded = ['id'];

    protected $table = 'inventory_types';

}
