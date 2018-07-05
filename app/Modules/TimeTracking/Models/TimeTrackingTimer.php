<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TimeTracking\Models;

use FI\Support\DateFormatter;
use FI\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class TimeTrackingTimer extends Model
{
    protected $table = 'time_tracking_timers';

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
    }

    public function getFormattedBilledAttribute()
    {
        return ($this->attributes['billed']) ? trans('fi.yes') : trans('fi.no');
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