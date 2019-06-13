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

use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeTrackingTimer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'time_tracking_timers';

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
    }

    public function getFormattedBilledAttribute()
    {
        return ($this->attributes['billed']) ? trans('bt.yes') : trans('bt.no');
    }

    public function getFormattedEndAtAttribute()
    {
        if ($this->attributes['end_at'] <> null)
        {
            return DateFormatter::format($this->attributes['end_at'], true);
        }

        return '';
    }

    public function getFormattedHoursAttribute()
    {
        return NumberFormatter::format($this->attributes['hours']);
    }

    public function getFormattedStartAtAttribute()
    {
        return DateFormatter::format($this->attributes['start_at'], true);
    }

    public function getHoursAttribute()
    {
        if (!$this->formatted_end_at)
        {
            return '';
        }

        return $this->attributes['hours'];
    }
}
