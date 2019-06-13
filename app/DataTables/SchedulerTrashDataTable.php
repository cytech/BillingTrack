<?php

namespace BT\DataTables;

use BT\Modules\Scheduler\Models\Schedule;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Schedule $schedule) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $schedule->id . '">';
            })
            ->editColumn('title', function (Schedule $schedule) {
              if ($schedule->isRecurring == 1){
                  return '<span style = "color:blue">' .$schedule->title.'</span>';
              }else{
                  return $schedule->title;
              }
            })
            ->rawColumns(['action', 'id','title']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
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
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters())
            ->parameters([
                'order' => [1, 'asc'],
                'lengthMenu' => [
                    [ 10, 25, 50, 100, -1 ],
                    [ '10', '25', '50', '100', 'All' ]
                ],
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
            'id'         =>
                ['name'       => 'id',
                 'data'       => 'id',
                 'orderable'  => false,
                 'searchable' => false,
                 'printable'  => false,
                 'exportable' => false,
                 'class'      => 'bulk-record',
                ],
            'title'       => [
                'title' => 'Title',
                'data'  => 'title',
            ],
            'deleted_at' => [
                'title' => 'Date Trashed',
                'data'  => 'deleted_at'
            ],
            'description'      => [
                'title' => trans('fi.description'),
                'data'  => 'description',
            ],
            'start_date'      => [
                'title' => trans('fi.start_date'),
                'name'  => 'latestOccurrence.formatted_start_date',
                'data'  => 'latest_occurrence.formatted_start_date',
                'orderable'  => false,
                'searchable' => false,
            ],
            'end_date'    => [
                'title'      => trans('fi.end_date'),
                'name'  => 'latestOccurrence.formatted_end_date',
                'data'  => 'latest_occurrence.formatted_end_date',
                'orderable'  => false,
                'searchable' => false,
            ],
            'category_name'     => [
                'title' => trans('fi.category'),
                'data'  => 'category.name',
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
        return 'Clients_' . date('YmdHis');
    }
}
