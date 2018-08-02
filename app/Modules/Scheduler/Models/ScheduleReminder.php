<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon\Carbon;

class ScheduleReminder extends Model
{
    use SoftDeletes;

	public $timestamps = true;

	protected $guarded = ['id'];

	protected $dates = ['reminder_date', 'deleted_at'];

	protected $table = 'schedule_reminders';



    public function newQuery()
    {
        if(Auth::check()){
            $query = parent::newQuery();
            $query->whereHas('Schedule', function($q)
            {
                $q->where('user_id', Auth::user()->id);

            });
            return $query;
        }else{
            $query = parent::newQuery();
            $query->whereHas('Schedule', function($q)
            {
                $q->where('user_id', '!=', 0);

            });
            return $query;
        }
    }

	public function getReminderDateAttribute($date){
		return Carbon::parse($this->attributes['reminder_date'])->format('Y-m-d H:i');
	}

    public function schedule()
    {
        return $this->belongsTo('FI\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }
}
