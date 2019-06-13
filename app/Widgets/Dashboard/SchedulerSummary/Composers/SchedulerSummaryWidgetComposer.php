<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Widgets\Dashboard\SchedulerSummary\Composers;

use Illuminate\Support\Facades\DB;
use BT\Modules\Scheduler\Models\ScheduleReminder;
use BT\Modules\Scheduler\Models\ScheduleOccurrence;
use Carbon\Carbon;

class SchedulerSummaryWidgetComposer
{
    public function compose($view)
    {
		    $view->with( 'schedulerEvents', $this->getSchedulerEvents() );
    }

    public function getSchedulerEvents()
    {
	        $today = new Carbon();

		    $data['monthEvent'] = ScheduleOccurrence::where( 'start_date', '>=', $today->copy()->modify( '0:00 first day of this month' ) )
		                                            ->where( 'start_date', '<=', $today->copy()->modify( '23:59:59 last day of this month' ) )
		                                            ->count();

		    $data['lastMonthEvent'] = ScheduleOccurrence::where( 'start_date', '>=', $today->copy()->modify( '0:00 first day of last month' ) )
		                                                ->where( 'start_date', '<=', $today->copy()->modify( '23:59:59 last day of last month' ) )
		                                                ->count();

		    $data['nextMonthEvent'] = ScheduleOccurrence::where( 'start_date', '>=', $today->copy()->modify( '0:00 first day of next month' ) )
		                                                ->where( 'start_date', '<=', $today->copy()->modify( '23:59:59 last day of next month' ) )
		                                                ->count();

		    $data['fullMonthEvent'] = ScheduleOccurrence::select( DB::raw( "count('id') as total, DATE_FORMAT(start_date, '%Y%m') as start_date" ) )
		                                                ->where( 'start_date', '>=', date( 'Y-m-01' ) )
		                                                ->where( 'start_date', '<=', date( 'Y-m-t' ) )
		                                                ->groupBy( 'start_date')
		                                                ->get();

		    $data['fullYearMonthEvent'] = ScheduleOccurrence::select( DB::raw( "count('id') as total, DATE_FORMAT(start_date, '%Y%m') as start_date" ) )
		                                                    ->where( 'start_date', '>=', date( 'Y-01-01' ) )
		                                                    ->where( 'start_date', '<=', date( 'Y-12-31' ) )
		                                                    ->groupBy('start_date' )
		                                                    ->get();

		    $data['reminders'] = ScheduleReminder::with( 'Schedule', 'Schedule.occurrences' )->where( 'reminder_date', '>=', $today->copy()->modify( '0:00' ) )->get();

		    return $data;

    }

}
