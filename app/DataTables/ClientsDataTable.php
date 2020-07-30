<?php

namespace BT\DataTables;

use BT\Modules\Clients\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class ClientsDataTable extends DataTable
{
    protected $actions_blade = 'clients';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', $this->actions_blade.'._actions')
            ->editColumn('id', function (Client $client) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $client->id . '">';
            })
            ->editColumn('unique_name', function (Client $client) {
                return '<a href="/clients/' . $client->id . '">' . $client->unique_name . '</a>';
            })
            ->rawColumns(['unique_name', 'action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Client $model
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
                ->className('bulk-record')
            ,
            Column::make('name')
                ->title(trans('bt.client_name'))
                ->data('unique_name'),
            Column::make('email')
                ->title(trans('bt.email_address')),
            Column::make('phone')
                ->title(trans('bt.phone_number')),
            Column::make('balance')
                ->title(trans('bt.balance'))
                ->data('formatted_balance')
                ->orderable(true)
                ->searchable(false),
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
        return 'Clients_' . date('YmdHis');
    }
}
