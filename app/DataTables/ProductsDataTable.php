<?php

namespace BT\DataTables;

use BT\Modules\Products\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class ProductsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', 'products._actions')
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        $models = $model->newQuery()
            ->with('category', 'vendor', 'inventorytype')
            ->with('taxRate', 'taxRate2')
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
            ->setTableId('products-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(5, 'asc')
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
                ->title(trans('bt.product_id'))
                ->orderable(true)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->hidden()
            ,
            Column::make('name')
                ->title(trans('bt.product_name')),
            Column::make('price')
                ->title(trans('bt.price_sales')),
            Column::make('vendor_id')
                ->title(trans('bt.vendor'))
                ->data('vendor.name'),
            Column::make('cost')
                ->title(trans('bt.product_cost')),
            Column::make('category_id')
                ->title(trans('bt.product_category'))
                ->data('category.name'),
            Column::make('inventorytype_id')
                ->title(trans('bt.product_type'))
                ->data('inventorytype.name'),
            Column::make('numstock')
                ->title(trans('bt.product_numstock')),
            Column::make('tax_rate_id')
                ->title(trans('bt.tax_1'))
                ->data('tax_rate.name')
                ->orderable(true)
                ->searchable(false),
            Column::make('tax_rate_2_id')
                ->title(trans('bt.tax_2'))
                ->data('tax_rate2.name')
                ->orderable(true)
                ->searchable(false),
            Column::make('active')
                ->title(trans('bt.product_active')),
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
