<?php

namespace BT\DataTables;

use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Support\Frequency;

class RecurringInvoicesTrashDataTable extends RecurringInvoicesDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $frequencies = Frequency::lists();

        return datatables()->eloquent($query)->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (RecurringInvoice $recurring_invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $recurring_invoice->id . '">';
            })
            ->editColumn('client.id', function (RecurringInvoice $recurring_invoice) {
                return '<a href="/clients/' . $recurring_invoice->client->id . '">' . $recurring_invoice->client->unique_name . '</a>';
            })
            ->editColumn('recurring_frequency', function (RecurringInvoice $recurring_invoice) use ($frequencies) {
                return $recurring_invoice->recurring_frequency . ' ' . $frequencies[$recurring_invoice->recurring_period];
            })
            ->orderColumn('formatted_next_date', 'next_date $1')
            ->orderColumn('formatted_stop_date', 'stop_date $1')
            ->rawColumns(['client.id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param RecurringInvoice $model
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
            ->removeColumn('amount.total')
            ->ajax(['data' => 'function(d) { d.table = "recurring_invoices"; }'])
            ->orderBy(2, 'asc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
