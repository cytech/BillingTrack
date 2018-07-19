<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Addons\Workorders\Repositories;

use Addons\Workorders\Models\Employee;
use Addons\Workorders\Models\Workorder;
use Addons\Scheduler\Models\Schedule;
use Addons\Scheduler\Models\ScheduleResource;
use Addons\Scheduler\Models\ScheduleOccurrence;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WorkorderToSchedulerRepository
{
    public function update($workorderId)
    {
        $workorder = Workorder::with('items')->find($workorderId);
        if ($workorder->workorder_status_id == 3) { //status is approved
            $schedule = Schedule::firstOrNew(['id' => $workorderId]);
            $schedule->id = $workorderId;
            $schedule->title = $workorder->client->name;
            //remove the flippin carriage return/line feeds from address or fullcalendar fails
            $schedule->description = $workorder->client->phone . '<br>'
                . str_replace(array("\r\n", "\r", "\n"), "", $workorder->client->address)
                . '<br>' . $workorder->client->city . '<br>' . mb_strimwidth($workorder->summary,0,50,'...') ;
            $schedule->user_id = $workorder->user_id;
            $schedule->category_id = 1;
            $schedule->url = url('/workorders') . '/' . $workorderId . '/edit';
            $schedule->will_call = $workorder->will_call;
            $schedule->save();

            $occurrence = ScheduleOccurrence::firstOrNew(['schedule_id' => $workorderId]);
            $occurrence->schedule_id = $schedule->id;
            $occurrence->start_date = $workorder->job_date->format('Y-m-d') . ' ' . date('H:i:s', strtotime($workorder->start_time));
            $occurrence->end_date = $workorder->job_date->format('Y-m-d') . ' ' . date('H:i:s', strtotime($workorder->end_time));
            $occurrence->save();

            //delete existing resources for the workorder
            ScheduleResource::where('schedule_id', '=', $workorderId)->delete();

            //then re-create the resources
            foreach ($workorder->workorderItems as $item) {
                if ($item->resource_table == 'employees') {
                    $employee = Employee::where('id', '=', $item->resource_id)->where('active', '=', true)->first();
                    if ($employee->schedule == 1) { //employee is scheduleable...
                        $scheduleItem = ScheduleResource::firstOrNew(['id' => $item['id']]);
                        $scheduleItem->id = $item['id'];
                        $scheduleItem->schedule_id = $item['workorder_id'];
                        $scheduleItem->fid = 2;
                        $scheduleItem->resource_table = $item->resource_table;
                        $scheduleItem->resource_id = $item->resource_id;
                        if ($employee->driver == 1) {
                            $scheduleItem->value = "<span style='color:blue'>" . $item->name . "</span>";
                        } else {
                            $scheduleItem->value = $item->name;
                        }
                        $scheduleItem->qty = $item->quantity;
                        $scheduleItem->save();
                    }
                } elseif ($item->resource_table == 'resources') {
                    $scheduleItem = ScheduleResource::firstOrNew(['id' => $item['id']]);
                    $scheduleItem->id = $item['id'];
                    $scheduleItem->schedule_id = $item['workorder_id'];
                    $scheduleItem->fid = 3;
                    $scheduleItem->resource_table = $item->resource_table;
                    $scheduleItem->resource_id = $item->resource_id;
                    $scheduleItem->value = $item->name;
                    $scheduleItem->qty = $item->quantity;
                    $scheduleItem->save();

                }
            }

        } else {
            try {
                $schedule = Schedule::findOrFail($workorderId);
                $schedule->forceDelete();

            } catch (ModelNotFoundException $ex) {

            }
        }
    }

    public function delete($workorderId)
    {
        try {
            $schedule = Schedule::withTrashed()->findOrFail($workorderId);
            $schedule->forceDelete();

        } catch (ModelNotFoundException $ex) {

        }
    }

	public function trash($workorderId)
	{
		try {
			$schedule = Schedule::findOrFail($workorderId);
			$schedule->delete();

		} catch (ModelNotFoundException $ex) {

		}
	}

	public function untrash($workorderId)
	{
		try {
			$schedule = Schedule::onlyTrashed()->findOrFail($workorderId);
			$schedule->restore();

		} catch (ModelNotFoundException $ex) {

		}
	}


}