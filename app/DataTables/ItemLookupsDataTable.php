<?php

namespace BT\DataTables;

use BT\Modules\ItemLookups\Models\ItemLookup;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class ItemLookupsDataTable extends DataTable
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
            ->addColumn('action', 'item_lookups._actions')
            ->rawColumns(['action', 'formatted_name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param ItemLookup $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItemLookup $model)
    {
        $models = $model->newQuery()
            ->with('taxRate', 'taxRate2');

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
            ->setTableId('itemlookups-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(6, 'asc')
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
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->hidden()
            ,
            Column::make('name')
                ->title(trans('bt.name'))
                ->data('formatted_name'),
            Column::make('description')
                ->title(trans('bt.description')),
            Column::make('price')
                ->title(trans('bt.price')),
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
            Column::make('resource_table')
                ->title(trans('bt.resource_table')),
            Column::make('resource_id')
                ->title(trans('bt.resource_id')),
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
        return 'ItemLookups_' . date('YmdHis');
    }
}
