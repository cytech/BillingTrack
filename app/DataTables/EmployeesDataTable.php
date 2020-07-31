<?php

namespace BT\DataTables;

use BT\Modules\Employees\Models\Employee;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class EmployeesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', 'employees._actions')
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        $models = $model->newQuery()
                        ->status(request('status'));

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
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(3, 'asc');
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
                ->title(trans('bt.id'))
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->hidden()
            ,
            Column::make('number')
                ->title(trans('bt.employee_number'))
                ->searchable(false),
            Column::make('first_name')
                ->title(trans('bt.first_name')),
            Column::make('last_name')
                ->title(trans('bt.last_name')),
            Column::make('short_name')
                ->title(trans('bt.employee_short_name')),
            Column::make('title')
                ->title(trans('bt.employee_title')),
            Column::make('billing_rate')
                ->title(trans('bt.employee_billing_rate')),
            Column::make('schedule')
                ->title(trans('bt.employees_scheduled')),
            Column::make('active')
                ->title(trans('bt.active')),
            Column::make('driver')
                ->title(trans('bt.employee_driver')),
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
        return 'Vendors_' . date('YmdHis');
    }
}
