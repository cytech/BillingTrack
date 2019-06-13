<?php

namespace BT\DataTables;

use BT\Modules\Scheduler\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SchedulerCategoriesDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'schedulecategories._actions')
                ->editColumn('text_color', function (Category $category) {
                    return $category->text_color . '   <i class="fa fa-square" style="color:'. $category->text_color .'"></i>';
                })
                ->editColumn('bg_color', function (Category $category) {
                    return $category->bg_color . '   <i class="fa fa-square" style="color:'. $category->bg_color .'"></i>';
                })
               ->rawColumns([ 'action', 'text_color', 'bg_color']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->select('schedule_categories.*');
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
            ->parameters(['order' => [0, 'asc']]);
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
                    'orderable'  => true,
                    'searchable' => false,
                    'printable'  => false,
                    'exportable' => false,

                ],
            'name' => [
                'title' => trans('bt.name'),
                'data' => 'name',
                'orderable'  => true,
                'searchable' => true,
            ],
            'text_color' => [
                    'title' => trans('bt.category_text_color'),
                    'data'       => 'text_color',
                    'orderable'  => true,
                    'searchable' => false,
                ],
            'bg_color' => [
                'title' => trans('bt.category_bg_color'),
                'data'       => 'bg_color',
                'orderable'  => true,
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
        return 'Categories_' . date('YmdHis');
    }
}
