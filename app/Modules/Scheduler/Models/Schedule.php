<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace FI\Modules\Scheduler\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Schedule extends Model {

    use SoftDeletes, SoftCascadeTrait, FormAccessible;

    protected $softCascade = ['reminders', 'occurrences', 'resources'];

    protected $dates = ['deleted_at'];

	protected $guarded = ['id'];

    protected $table = 'schedule';

    public $timestamps = true;


    public function category()
    {
        return $this->hasOne('FI\Modules\Scheduler\Models\Category', 'id', 'category_id');
    }

    public function occurrences()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleOccurrence', 'schedule_id', 'id');
    }

    public function latestOccurrence()
    {
        return $this->hasOne('FI\Modules\Scheduler\Models\ScheduleOccurrence', 'schedule_id', 'id')->latest();
    }

    public function reminders()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleReminder', 'schedule_id', 'id');
    }

    public function resources()
    {
        return $this->hasMany('FI\Modules\Scheduler\Models\ScheduleResource','schedule_id', 'id');
    }

    //getters
    //below for form model binding
    public function formStartDateAttribute() {
        return Carbon::parse( $this->attributes['start_date'] )->format( 'Y-m-d H:i' );
    }

    public function formEndDateAttribute() {
        return Carbon::parse( $this->attributes['end_date'] )->format( 'Y-m-d H:i' );
    }

    //scopes
    public function scopeWithOccurrences($query){
        $query->leftjoin('schedule_occurrences','schedule.id', '=',
            'schedule_occurrences.schedule_id');
    }

}
