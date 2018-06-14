<?php

namespace Addons\TimeTracking;

use Addons\TimeTracking\Models\TimeTrackingProject;
use Addons\TimeTracking\Models\TimeTrackingTask;
use Addons\TimeTracking\Models\TimeTrackingTimer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen('timeTracking.project.creating', function($project)
        {
            $project->status_id = 1;
        });

        Event::listen('timeTracking.project.deleted', function ($project)
        {
            TimeTrackingTimer::whereIn('time_tracking_task_id', function ($query) use ($project)
            {
                $query->select('id')->from('time_tracking_tasks')->where('time_tracking_project_id', $project->id);
            })->delete();

            TimeTrackingTask::where('time_tracking_project_id', $project->id)->delete();
        });

        Event::listen('timeTracking.task.deleted', function ($task)
        {
            TimeTrackingTimer::where('time_tracking_task_id', $task->id)->delete();
        });

        Event::listen('FI\Events\ClientDeleted', function ($event)
        {
            $projects = TimeTrackingProject::where('client_id', $event->client->id)->get();

            foreach ($projects as $project)
            {
                $project->delete();
            }
        });

        Event::listen('FI\Events\InvoiceDeleted', function ($event)
        {
            TimeTrackingTask::where('invoice_id', $event->invoice->id)->update(['invoice_id' => 0, 'billed' => 0]);
        });
    }

    public function register()
    {
        //
    }
}
