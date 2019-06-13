<?php

namespace BT\DataTables;

use BT\Modules\Clients\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClientsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'clients._actions')
            ->editColumn('id', function (Client $client) {
                return '<input type="checkbox" class="bulk-record" data-id="'. $client->id .'">';
            })
            ->editColumn('unique_name', function (Client $client) {
                return '<a href="/clients/' . $client->id . '">' . $client->unique_name . '</a>';
            })
            ->rawColumns(['unique_name', 'action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        $models = $model->newQuery()->getSelect()
                        ->leftJoin('clients_custom', 'clients_custom.client_id', '=', 'clients.id')
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
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters(['order' => [1, 'asc']]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' =>
                ['name' => 'id',
                 'data' => 'id',
                 'orderable' => false,
                 'searchable' => false,
                 'printable' => false,
                 'exportable' => false,
                 'class'=>'bulk-record',
            ],
            'name' => [
                'title' => trans('bt.client_name'),
                'data' => 'unique_name',
            ],
            'email' => [
                'title' => trans('bt.email_address'),
                'data' => 'email',
            ],
            'phone' => [
                'title' => trans('bt.phone_number'),
                'data' => 'phone',
            ],
            'balance' => [
                'name' => 'balance',
                'title' => trans('bt.balance'),
                'data' => 'formatted_balance',
                'orderable' => true,
                'searchable' => false,
            ],
            'active' => [
                'title' => trans('bt.active'),
                'data' => 'active',
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
