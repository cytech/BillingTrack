<?php

/**
 * This file is part of FusionInvoiceFOSS.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TimeTracking\Controllers;

use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use FI\Modules\TimeTracking\Models\TimeTrackingTask;
use FI\Modules\TimeTracking\Requests\TaskRequest;
use FI\Http\Controllers\Controller;

class TaskController extends Controller
{

    public function create()
    {
        return view('time_tracking._task_create_modal')
            ->with('project', TimeTrackingProject::find(request('project_id')));
    }

    public function store(TaskRequest $request)
    {

        TimeTrackingTask::create($request->all());
    }

    public function edit()
    {
        $task = TimeTrackingTask::find(request('id'));

        return view('time_tracking._task_edit_modal')
            ->with('project', $task->project()->getSelect()->first())
            ->with('task', $task);
    }

    public function update(TaskRequest $request)
    {

        TimeTrackingTask::find($request->id)->fill($request->only(['name']))->save();
    }

    public function updateDisplayOrder()
    {
        $displayOrder = 1;

        foreach (request('task_ids') as $id)
        {
            $id = str_replace('task_id_', '', $id);

            TimeTrackingTask::where('id', $id)->update(['display_order' => $displayOrder]);

            $displayOrder++;
        }
    }

    public function delete()
    {
        foreach (request('ids') as $id)
        {
            TimeTrackingTask::destroy($id);
        }
    }
}