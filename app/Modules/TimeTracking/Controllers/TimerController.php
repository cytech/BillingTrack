<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\TimeTracking\Controllers;

use BT\Modules\TimeTracking\Models\TimeTrackingTask;
use BT\Modules\TimeTracking\Models\TimeTrackingTimer;
use BT\Modules\TimeTracking\Requests\TimerRequest;
use Carbon\Carbon;
use BT\Http\Controllers\Controller;

class TimerController extends Controller
{
    private $timerValidator;
    private $timeTrackingTask;

    public function __construct(
        TimeTrackingTask $timeTrackingTask
    )
    {
        $this->timeTrackingTask = $timeTrackingTask;
    }

    public function start()
    {
        if (TimeTrackingTimer::where('time_tracking_task_id', request('task_id'))->where('end_at', null)->count() == 0)
        {
            $timer = new TimeTrackingTimer([
                'time_tracking_task_id' => request('task_id'),
                'start_at'              => date('Y-m-d H:i:s'),
            ]);

            $timer->save();
        }
    }

    public function stop()
    {
        $endAt = date('Y-m-d H:i:s');

        $timer = TimeTrackingTimer::find(request('timer_id'));

        $startAt = Carbon::parse($timer->start_at);
        $endAt   = Carbon::parse($endAt);

        $timer->end_at = $endAt;
        $timer->hours  = $endAt->diffInSeconds($startAt) / 60 / 60;
        $timer->save();
    }

    public function show()
    {
        $task = TimeTrackingTask::find(request('time_tracking_task_id'));

        return view('time_tracking._timer_modal')
            ->with('task', $task)
            ->with('project', $task->project)
            ->with('timers', $task->timers);
    }

    public function store(TimerRequest $request)
    {

        $timer = new TimeTrackingTimer($request->all());

        $startAt = Carbon::parse($request->start_at);
        $endAt   = Carbon::parse($request->end_at);

        $timer->end_at = $endAt;
        $timer->hours  = $endAt->diffInSeconds($startAt) / 60 / 60;
        $timer->save();
    }

    public function delete()
    {
        TimeTrackingTimer::destroy(request('id'));
    }

    public function seconds()
    {
        $seconds = 0;

        $timers = TimeTrackingTimer::where('time_tracking_task_id', request('task_id'))->get();

        foreach ($timers as $timer)
        {
            if ($timer->end_at != '0000-00-00 00:00:00')
            {
                $endAt = Carbon::parse($timer->end_at);
            }
            else
            {
                $endAt = Carbon::now();
            }

            $startAt = Carbon::parse($timer->start_at);

            $seconds += $endAt->diffInSeconds($startAt);
        }

        return $seconds;
    }

    public function refreshList()
    {
        $timers = TimeTrackingTimer::where('time_tracking_task_id', request('time_tracking_task_id'))
            ->orderBy('start_at', 'desc')
            ->get();

        return view('time_tracking._timer_list')
            ->with('timers', $timers);
    }
}
