<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace BT\Modules\Scheduler\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'schedule_categories';

	public $timestamps = false;

	protected $fillable = [ 'name', 'text_color', 'bg_color' ];

    protected $dates = ['deleted_at'];

    public function getInUseAttribute()
    {
        if (Schedule::where('category_id',$this->id)->count())
        {
            return true;
        }

        return false;
    }
}
