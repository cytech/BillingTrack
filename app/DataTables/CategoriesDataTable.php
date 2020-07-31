<?php

namespace BT\DataTables;

use BT\Modules\Categories\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class CategoriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->editColumn('action', function (Category $category) {
                return '<a href="/categories/' . $category->id . '/edit" class="btn btn-primary btn-sm "><i
                            class="fa fa-edit"></i>
                    ' . trans('bt.edit') . ' </a>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        $models = $model->newQuery();

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
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc');
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
                ->orderable(true)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->hidden()
            ,
            Column::make('name')
                ->title(trans('bt.name')),
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
        return 'Categories_' . date('YmdHis');
    }
}
