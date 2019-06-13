<?php

namespace BT\DataTables;

use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProjectsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'time_tracking._actions')
            ->editColumn('id', function (TimeTrackingProject $project) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $project->id . '">';
            })
            ->editColumn('name', function (TimeTrackingProject $project){
                return '<a href="'. route('timeTracking.projects.edit', [$project->id]) .'">'. $project->name .'</a>';
            })
            ->editColumn('client_name', function (TimeTrackingProject $project){
                return '<a href="'. route('clients.show', [$project->client->id]) .'">'. $project->client->name .'</a>';
            })
            ->orderColumn('formatted_created_at', 'created_at $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->orderColumn('status_text', 'status_id $1')
            ->rawColumns([  'client_name', 'name', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TimeTrackingProject $model)
    {
        return $model->getSelect()
            ->companyProfileId(request('company_profile'))
            ->statusId(request('status'));
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
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters());
            ->parameters(['order' => [5, 'desc']]);
    }

    /**
     * Get columns.
     *
     * @return array
     * TODO problems with eloquent using getter on nested relation for ordering/search
     */
    protected function getColumns()
    {
        return [
            'id' =>
                [   'name'       => 'id',
                    'data'       => 'id',
                    'orderable'  => false,
                    'searchable' => false,
                    'printable'  => false,
                    'exportable' => false,
                    'class'      => 'bulk-record',
                ],
            'project'   => [
                'title' => trans('fi.project'),
                'data'       => 'name',
            ],
            'client'   => [
                'title' => trans('fi.client'),
                'data'       => 'client_name',
                'searchable' => false,
            ],
            'status' => [
                'title' => trans('fi.status'),
                'data' => 'status_text',
                'searchable' => false,
            ],
            'created' => [
                    'title' => trans('fi.created'),
                    'data'       => 'formatted_created_at',
                    'searchable' => false,
                ],
            'due_date' => [
                'title' => trans('fi.due_date'),
                'data'       => 'formatted_due_at',
                'searchable' => false,
            ],
            'unbilled_hours'   => [
                'title' => trans('fi.unbilled_hours'),
                'data'       => 'unbilled_hours',
                'searchable' => false,
            ],
            'billed_hours'   => [
                'title' => trans('fi.billed_hours'),
                'data'       => 'billed_hours',
                'searchable' => false,
            ],
            'total_hours'   => [
                'title' => trans('fi.total_hours'),
                'data'       => 'hours',
                'searchable' => false,
            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Projects_' . date('YmdHis');
    }
}
