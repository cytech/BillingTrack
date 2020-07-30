<?php

namespace BT\DataTables;

use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class ProjectsDataTable extends DataTable
{
    protected $actions_blade = 'time_tracking';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', $this->actions_blade.'._actions')
            ->editColumn('id', function (TimeTrackingProject $project) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $project->id . '">';
            })
            ->editColumn('client.name', function (TimeTrackingProject $project) {
                return '<a href="' . route('clients.show', [$project->client->id]) . '">' . $project->client->name . '</a>';
            })
            ->orderColumn('formatted_created_at', 'created_at $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->orderColumn('status_text', 'status_id $1')
            ->rawColumns(['client.name', 'name', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param TimeTrackingProject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TimeTrackingProject $model)
    {
        return $model->getSelect()
            ->with('client')
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
            ->orderBy(5, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->className('bulk-record')
            ,
            Column::make('name')
                ->title(trans('bt.project')),
            Column::make('client_id')
                ->name('client.name')
                ->title(trans('bt.client'))
                ->data('client.name')
                ->searchable(false),
            Column::make('status_id')
                ->title(trans('bt.status'))
                ->data('status_text')
                ->searchable(false),
            Column::make('created_at')
                ->title(trans('bt.created'))
                ->data('formatted_created_at')
                ->searchable(false),
            Column::make('due_at')
                ->title(trans('bt.due_date'))
                ->data('formatted_due_at')
                ->searchable(false),
            Column::make('unbilled_hours')
                ->title(trans('bt.unbilled_hours'))
                ->searchable(false),
            Column::make('billed_hours')
                ->title(trans('bt.billed_hours'))
                ->searchable(false),
            Column::make('total_hours')
                ->name('hours')
                ->title(trans('bt.total_hours'))
                ->data('hours')
                ->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),

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
