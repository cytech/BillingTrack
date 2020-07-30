<?php

namespace BT\DataTables;

use BT\Modules\Scheduler\Models\Schedule;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class SchedulerTrashDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Schedule $schedule) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $schedule->id . '">';
            })
            ->editColumn('title', function (Schedule $schedule) {
                if ($schedule->isRecurring == 1) {
                    return '<span style = "color:blue">' . $schedule->title . '</span>';
                } else {
                    return $schedule->title;
                }
            })
            ->rawColumns(['action', 'id', 'title']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Schedule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Schedule $model)
    {
        return $model->with(['latestOccurrence' => function ($q) {
            $q->onlyTrashed();
        }, 'category'])->select('schedule.*')->onlyTrashed();


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
            ->ajax(['data' => 'function(d) { d.table = "schedule"; }'])
            ->orderBy(1, 'asc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
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
            Column::make('title')
                ->title(trans('bt.title')),
            Column::make('deleted_at')
                ->title(trans('bt.date_trashed'))
                ->data('formatted_date_trashed'),
            Column::make('description')
                ->title(trans('bt.description')),
            Column::make('start_date')
                ->title(trans('bt.start_date'))
                ->name('latestOccurrence.start_date')
                ->data('latest_occurrence.formatted_start_date')
                ->orderable(true)
                ->searchable(true),
            Column::make('end_date')
                ->title(trans('bt.end_date'))
                ->name('latestOccurrence.end_date')
                ->data('latest_occurrence.formatted_end_date')
                ->orderable(true)
                ->searchable(false),
            Column::make('category')
                ->title(trans('bt.category'))
                ->name('category.name')
                ->data('category.name'),
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
        return 'Schedule_' . date('YmdHis');
    }
}
