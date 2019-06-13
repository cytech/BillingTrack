<?php

namespace BT\DataTables;

use BT\Modules\Scheduler\Models\Schedule;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RecurringEventsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'partials._actions_recurr')
            ->editColumn('id', function (Schedule $schedule) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $schedule->id . '">';
            })
            //->orderColumn('rule_start', 'schedule_occurrences.start_date $1')
            ->rawColumns([ 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Schedule $model)
    {
        $models = $model->with(['category'])->where('isRecurring', '=', '1')
                        ->select('schedule.*');

        return $models;
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
            ->parameters(['order'      => [3, 'desc'],
                          'lengthMenu' => [
                              [10, 25, 50, 100, -1],
                              ['10', '25', '50', '100', 'All']
                          ],]);
    }

    /**
     * Get columns.
     *
     * @return array
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
            'title'  => [
                'title' => trans('fi.title'),
                'data' => 'title',
            ],
            'description'  => [
                'title' => trans('fi.description'),
                'data' => 'description',
            ],
            'start_date' => [
                'title' => trans('fi.start_date'),
                //'name' => 'firstOccurrence.start_date',
                'data' => 'rule_start',
                'orderable'  => false,
                'searchable' => false,
            ],
            'frequency'    => [
                'title' => trans('fi.frequency'),
                'data'       => 'text_trans',
                'orderable'  => false,
                'searchable' => false,
            ],
            'category'     => [
                'title' => trans('fi.category'),
                'data'       => 'category.name',
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
        return 'Schedule_' . date('YmdHis');
    }
}
