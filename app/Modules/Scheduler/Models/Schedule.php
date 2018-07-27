<?php

/**
 * This file is part of Scheduler Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
Use Carbon\Carbon;


class Schedule extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $guarded = ['id'];

    protected $table = 'schedule';

    public $timestamps = true;

	//necessary here for scope below
	public function getStartDateAttribute() {
		return Carbon::parse( $this->attributes['start_date'] )->format( 'Y-m-d H:i' );
	}

	public function getEndDateAttribute() {
		return Carbon::parse( $this->attributes['end_date'] )->format( 'Y-m-d H:i' );
	}

	public function scopeWithOccurrences($query){
		$query->leftjoin('schedule_occurrences','schedule.id', '=',
			'schedule_occurrences.schedule_id');
	}

    public function category()
    {
        return $this->hasOne('FI\Modules\Scheduler\Models\Category', 'id', 'category_id');
    }

    public function occurrences()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleOccurrence', 'schedule_id', 'id');
    }

    public function reminders()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleReminder', 'schedule_id', 'id');
    }

    public function resources()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleResource','schedule_id', 'id');
    }

}
