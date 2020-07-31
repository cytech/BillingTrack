<?php

namespace BT\DataTables;

use BT\Modules\Vendors\Models\Vendor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class VendorsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', 'vendors._actions')
            ->editColumn('name', function (Vendor $vendor) {
                return '<a href="/vendors/' . $vendor->id . '">' . $vendor->name . '</a>';
            })
            ->rawColumns(['name', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Vendor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vendor $model)
    {
        $models = $model->newQuery()->getSelect()
                        ->leftJoin('vendors_custom', 'vendors_custom.vendor_id', '=', 'vendors.id')
                        ->with(['currency'])
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
            ->setTableId('vendors-table')
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
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->hidden()
            ,
            Column::make('name')
                ->title(trans('bt.vendor_name')),
            Column::make('email')
                ->title(trans('bt.email_address')),
            Column::make('phone')
                ->title(trans('bt.phone_number')),
            Column::make('active')
                ->title(trans('bt.active')),
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
