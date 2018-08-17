<?php

namespace FI\DataTables;

use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Support\Frequency;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RecurringInvoicesTrashDataTable extends DataTable
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

        $frequencies = Frequency::lists();

        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (RecurringInvoice $recurring_invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $recurring_invoice->id . '">';
            })
            ->editColumn('client.id', function (RecurringInvoice $recurring_invoice) {
                return '<a href="/clients/' . $recurring_invoice->client->id . '">' . $recurring_invoice->client->unique_name . '</a>';
            })
            ->editColumn('recurring_frequency', function (RecurringInvoice $recurring_invoice) use ($frequencies){
                return $recurring_invoice->recurring_frequency .' '. $frequencies[$recurring_invoice->recurring_period];
            })
            ->orderColumn('formatted_next_date', 'next_date $1')
            ->orderColumn('formatted_stop_date', 'stop_date $1')
            ->rawColumns([ 'client.id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RecurringInvoice $model)
    {
        $models = $model->has('client')->with('client')
            ->select('recurring_invoices.*', 'recurring_invoices.id as number')
            ->onlyTrashed();

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
            ->ajax(['data' => 'function(d) { d.table = "recurring_invoices"; }'])
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters())
            ->parameters([
                'order' => [2, 'asc'],
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
            'id' =>
                [   'name'       => 'id',
                    'data'       => 'id',
                    'orderable'  => false,
                    'searchable' => false,
                    'printable'  => false,
                    'exportable' => false,
                    'class'      => 'bulk-record',
                ],
            'Number' =>
                [   'name'       => 'number',
                    'data'       => 'number',
                    'width'      => '5%',
                ],
            'client'  => [
                'title' => trans('fi.client'),
                'data' => 'client.id',
            ],
            'summary' => [
                'title' => trans('fi.summary'),
                'data' => 'summary',
            ],
            'next_date'    => [
                'title' => trans('fi.next_date'),
                'data'       => 'formatted_next_date',
                'searchable' => false,
            ],
            'stop_date'    => [
                'title' => trans('fi.stop_date'),
                'data'       => 'formatted_stop_date',
                'searchable' => false,
            ],
            'every' => [
                'title' => trans('fi.every'),
                'data'       => 'recurring_frequency',
                'orderable'  => false,
                'searchable' => false,
            ],
            /*'total'   => [
                'title' => trans('fi.total'),
                'data'       => 'amount.formatted_total',
                'orderable'  => false,
                'searchable' => false,
            ],*/

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'RecurringInvoices_' . date('YmdHis');
    }
}
