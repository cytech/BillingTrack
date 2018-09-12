<?php

namespace FI\Widgets\Dashboard\TodaysWorkorders\Composers;

use Carbon\Carbon;
use FI\Modules\Workorders\Models\Workorder;

class TodaysWorkordersWidgetComposer
{
    public function compose($view)
    {
        $today = new Carbon();

        $todaysWorkorders = Workorder::where( 'job_date', '=', $today->format('Y-m-d'))
            ->where('workorder_status_id', 3)->get();

        $view->with('todaysWorkorders', $todaysWorkorders);
    }
}