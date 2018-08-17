<?php

namespace FI\DataTables;

use FI\Modules\Clients\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClientsTrashDataTable extends DataTable
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
            ->editColumn('id', function (Client $client) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $client->id . '">';
            })
            ->rawColumns(['action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "clients"; }'])
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
            'name'       => [
                'title' => 'Name / Number',
                'data'  => 'unique_name',
            ],
            'deleted_at' => [
                'title' => 'Date Trashed',
                'data'  => 'deleted_at'
            ],
            'email'      => [
                'title' => trans('fi.email_address'),
                'data'  => 'email',
            ],
            'phone'      => [
                'title' => trans('fi.phone_number'),
                'data'  => 'phone',
            ],
            'balance'    => [
                'title'      => trans('fi.balance'),
                'data'       => 'formatted_balance',
                'orderable'  => false,
                'searchable' => false,
            ],
            'active'     => [
                'title' => trans('fi.active'),
                'data'  => 'active',
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
