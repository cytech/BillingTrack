<?php

namespace BT\DataTables;

use BT\Modules\Scheduler\Models\Schedule;

class SchedulerTrashDataTable extends SchedulerDataTable
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
}
