<?php

namespace BT\DataTables;

use BT\Modules\Clients\Models\Client;

class ClientsTrashDataTable extends ClientsDataTable
{
    protected $actions_blade = 'utilities';
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
            ->rawColumns(['action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Client $model
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
            ->removeColumn('balance')
            ->ajax(['data' => 'function(d) { d.table = "clients"; }'])
            ->orderBy(1, 'asc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
