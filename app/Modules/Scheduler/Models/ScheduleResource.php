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

class ScheduleResource extends Model {

    use SoftDeletes;

    protected $table = 'schedule_resources';

    public $timestamps = false;

	protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public function schedule()
    {
        return $this->belongsTo('BT\Modules\Scheduler\Models\Schedule', 'schedule_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany('BT\Modules\Employees\Models\Employee', 'id', 'resource_id');
    }

    public function occurrence()
    {
        return$this->hasOneThrough(ScheduleOccurrence::class, Schedule::class, 'id','schedule_id');
    }



}
