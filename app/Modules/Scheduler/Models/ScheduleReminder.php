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
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ScheduleReminder extends Model
{
    use SoftDeletes;

	public $timestamps = true;

	protected $guarded = ['id'];

	protected $dates = ['reminder_date', 'deleted_at'];

	protected $table = 'schedule_reminders';

	public function getReminderDateAttribute($date){
		return Carbon::parse($this->attributes['reminder_date'])->format('Y-m-d H:i');
	}

    public function schedule()
    {
        return $this->belongsTo('BT\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }
}
