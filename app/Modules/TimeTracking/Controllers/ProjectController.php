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

use FI\DataTables\ProjectsDataTable;
use FI\Modules\TimeTracking\Models\TimeTrackingProject;
use FI\Modules\TimeTracking\Models\TimeTrackingTask;
use FI\Modules\TimeTracking\Requests\ProjectRequest;
use FI\Support\Statuses\TimeTrackingProjectStatuses;
use FI\Http\Controllers\Controller;
use FI\Modules\Clients\Models\Client;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Traits\ReturnUrl;
use FI\Support\DateFormatter;

class ProjectController extends Controller
{
    use ReturnUrl;

    public function index(ProjectsDataTable $dataTable)
    {
        $this->setReturnUrl();
        $statuses = ['' => trans('fi.all_statuses')] + TimeTrackingProjectStatuses::lists();
        $companyProfiles = ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList();
        $keyedStatuses = collect(TimeTrackingProjectStatuses::lists());

        return $dataTable->render('time_tracking.project_index', compact('keyedStatuses','statuses', 'companyProfiles'));
    }

    public function create()
    {
        return view('time_tracking.project_create')
            ->with('companyProfiles', CompanyProfile::getList());
    }

    public function store(ProjectRequest $request)
    {

        $input = $request->except('client_name');

        $input['client_id'] = Client::firstOrCreateByUniqueName(request('client_name'))->id;
        $input['user_id']   = auth()->user()->id;
        $input['due_at'] = DateFormatter::unformat($input['due_at']);
        $input['status_id'] = 1;

        $project = TimeTrackingProject::create($input);

        return redirect()->route('timeTracking.projects.edit', [$project->id]);
    }

    public function edit($id)
    {
        $this->setReturnUrl();

        $project = TimeTrackingProject::getSelect()->find($id);

        return view('time_tracking.project_edit')
            ->with('companyProfiles', CompanyProfile::getList())
            ->with('project', $project)
            ->with('tasks', $project->tasks()->getSelect()->unbilled()->orderBy('display_order')->get())
            ->with('tasksBilled', $project->tasks()->getSelect()->billed()->orderBy('display_order')->get())
            ->with('returnUrl', $this->getReturnUrl())
            ->with('statuses', TimeTrackingProjectStatuses::lists());
    }

    public function update(ProjectRequest $request, $id)
    {

        $input = $request->except('client_name');

        $input['client_id'] = Client::firstOrCreateByUniqueName(request('client_name'))->id;
        $input['due_at'] = DateFormatter::unformat($input['due_at']);

        TimeTrackingProject::find($id)
            ->fill($input)
            ->save();

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    public function delete($id)
    {
        TimeTrackingProject::destroy($id);

        return redirect()->route('timeTracking.projects.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    public function bulkDelete()
    {
        TimeTrackingProject::destroy(request('ids'));
    }

    public function bulkStatus()
    {
        TimeTrackingProject::whereIn('id', request('ids'))->update(['status_id' => request('status')]);
    }


    public function refreshTaskList()
    {
        $project = TimeTrackingProject::find(request('project_id'));

        $tasks = TimeTrackingTask::getSelect()
            ->where('time_tracking_project_id', request('project_id'))
            ->orderBy('display_order')
            ->orderBy('created_at')
            ->unbilled()
            ->get();

        return view('time_tracking._task_list')
            ->with('project', $project)
            ->with('tasks', $tasks);
    }

    public function refreshTotals()
    {
        return view('time_tracking._project_edit_totals')
            ->with('project', TimeTrackingProject::getSelect()->find(request('project_id')));
    }
}