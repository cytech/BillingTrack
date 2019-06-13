<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TimeTracking\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use BT\Support\Statuses\TimeTrackingProjectStatuses;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TimeTrackingProject extends Model
{
    use SoftDeletes;

    use SoftCascadeTrait;

    protected $softCascade = ['tasks'];

    protected $dates = ['deleted_at'];

    protected $table = 'time_tracking_projects';

    protected $guarded = ['id'];

    protected $appends = ['status_text', 'formatted_created_at', 'formatted_due_at'];

    public static function getList($status = null)
    {
        return self::status($status)->orderBy('created_at', 'desc')->lists('name', 'id')->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('BT\Modules\Clients\Models\Client');
    }

    public function companyProfile()
    {
        return $this->belongsTo('BT\Modules\CompanyProfiles\Models\CompanyProfile');
    }

    public function tasks()
    {
        return $this->hasMany('BT\Modules\TimeTracking\Models\TimeTrackingTask');
    }

    public function user()
    {
        return $this->belongsTo('BT\Modules\Users\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedCreatedAtAttribute()
    {
        return DateFormatter::format($this->attributes['created_at']);
    }

    public function getFormattedDueAtAttribute()
    {
        return DateFormatter::format($this->attributes['due_at']);
    }

    public function getFormattedHourlyRateAttribute()
    {
        return CurrencyFormatter::format($this->attributes['hourly_rate']);
    }

    public function getStatusTextAttribute()
    {
        $statuses = TimeTrackingProjectStatuses::lists();

        if (isset($statuses[$this->attributes['status_id']]))
        {
            return $statuses[$this->attributes['status_id']];
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeGetSelect($query)
    {
        return $query->select(
            'time_tracking_projects.*',
            'clients.unique_name AS client_name',
            DB::raw('(' . $this->getHoursSql() . ') AS hours'),
            DB::raw('(' . $this->getUnbilledHoursSql() . ') AS unbilled_hours'),
            DB::raw('(' . $this->getBilledHours() . ') AS billed_hours')
        )->leftJoin('clients', 'clients.id', '=', 'time_tracking_projects.client_id');
    }

    public function scopeCompanyProfileId($query, $companyProfileId = null)
    {
        if ($companyProfileId)
        {
            $query->where('company_profile_id', $companyProfileId);
        }

        return $query;
    }

    public function scopeStatusId($query, $statusId = null)
    {
        if ($statusId)
        {
            $query->where('status_id', $statusId);
        }

        return $query;
    }

    public function scopeDateRange($query, $fromDate, $toDate)
    {
        return $query->where('due_at', '>=', $fromDate)
            ->where('due_at', '<=', $toDate);
    }

    /*
    |--------------------------------------------------------------------------
    | Subqueries
    |--------------------------------------------------------------------------
    */

    private function getHoursSql()
    {
        return DB::table('time_tracking_timers')
            ->selectRaw('IFNULL(SUM(hours), 0.00)')
            ->join('time_tracking_tasks', 'time_tracking_tasks.id', '=', 'time_tracking_timers.time_tracking_task_id')
            ->where('time_tracking_tasks.time_tracking_project_id', '=', DB::raw(DB::getTablePrefix() . 'time_tracking_projects.id'))
            ->toSql();
    }

    private function getUnbilledHoursSql()
    {
        return DB::table('time_tracking_timers')
            ->selectRaw('IFNULL(SUM(hours), 0.00)')
            ->join('time_tracking_tasks', 'time_tracking_tasks.id', '=', 'time_tracking_timers.time_tracking_task_id')
            ->where('time_tracking_tasks.time_tracking_project_id', '=', DB::raw(DB::getTablePrefix() . 'time_tracking_projects.id'))
            ->where('time_tracking_tasks.billed', DB::raw(0))
            ->toSql();
    }

    private function getBilledHours()
    {
        return DB::table('time_tracking_timers')
            ->selectRaw('IFNULL(SUM(hours), 0.00)')
            ->join('time_tracking_tasks', 'time_tracking_tasks.id', '=', 'time_tracking_timers.time_tracking_task_id')
            ->where('time_tracking_tasks.time_tracking_project_id', '=', DB::raw(DB::getTablePrefix() . 'time_tracking_projects.id'))
            ->where('time_tracking_tasks.billed', DB::raw(1))
            ->toSql();
    }
}
