<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\PaymentMethods\Models;

use BT\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    protected $sortable = ['name'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function getList()
    {
        return self::orderBy('name')->pluck('name', 'id')->all();
    }
}
