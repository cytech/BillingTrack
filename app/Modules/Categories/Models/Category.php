<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function getList()
    {
        return self::whereIn('id', function ($query)
        {
            $query->select('category_id')->distinct()->from('expenses');
        })->orderBy('name')
            ->pluck('name', 'id')
            ->all();
    }
}
