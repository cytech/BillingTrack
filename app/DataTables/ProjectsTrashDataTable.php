<?php

namespace BT\DataTables;

use BT\Modules\TimeTracking\Models\TimeTrackingProject;

class ProjectsTrashDataTable extends ProjectsDataTable
{
    protected $actions_blade = 'utilities';

    /**
     * Get query source of dataTable.
     *
     * @param TimeTrackingProject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TimeTrackingProject $model)
    {
        return $model->has('client')->with('client')->getSelect()
            ->companyProfileId(request('company_profile'))
            ->statusId(request('status'))
            ->onlyTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax(['data' => 'function(d) { d.table = "projects"; }'])
            ->orderBy(5, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
