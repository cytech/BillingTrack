<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace BT\Modules\Scheduler\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Recurr\Exception\InvalidRRule;
use Recurr\Rule;
use Recurr\Transformer\TextTransformer;

class Schedule extends Model {

    use SoftDeletes, SoftCascadeTrait, FormAccessible;

    protected $softCascade = ['reminders', 'occurrences', 'resources'];

    protected $appends = ['text_trans', 'rule_start', 'formatted_date_trashed'];

    protected $dates = ['deleted_at'];

	protected $guarded = ['id'];

    protected $table = 'schedule';

    public $timestamps = true;


    public function category()
    {
        return $this->hasOne('BT\Modules\Scheduler\Models\Category', 'id', 'category_id');
    }

    public function occurrences()
    {
        return $this->hasMany('BT\Modules\Scheduler\Models\ScheduleOccurrence', 'schedule_id', 'id');
    }

    public function occurrence()
    {
        return $this->hasOne('BT\Modules\Scheduler\Models\ScheduleOccurrence', 'schedule_id', 'id');
    }

    public function latestOccurrence()
    {
        return $this->occurrence()->latest('start_date');
    }

    public function firstOccurrence()
    {
        return $this->occurrence()->oldest('start_date');
    }

    public function reminders()
    {
        return $this->hasMany('BT\Modules\Scheduler\Models\ScheduleReminder', 'schedule_id', 'id');
    }

    public function resources()
    {
        return $this->hasMany('BT\Modules\Scheduler\Models\ScheduleResource','schedule_id', 'id');
    }

    //getters
    public function getTextTransAttribute(){
        try {
            $rule = new Rule($this->rrule, new \DateTime());
        } catch (InvalidRRule $e) {
        }
        $textTransformer = new TextTransformer();
        return $textTransformer->transform($rule);
    }

    public function getRuleStartAttribute(){
        if ($this->rrule) {
            $rule = Rule::createFromString($this->rrule);
            return $rule->getStartDate()->format('Y-m-d H:i');
        }
        return;
    }

    public function getFormattedDateTrashedAttribute() {
        return Carbon::parse( $this->attributes['deleted_at'] )->format( 'Y-m-d H:i' );
    }

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
