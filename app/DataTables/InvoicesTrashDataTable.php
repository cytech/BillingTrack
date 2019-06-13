<?php

namespace BT\DataTables;

use BT\Modules\Invoices\Models\Invoice;
use BT\Support\Statuses\InvoiceStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class InvoicesTrashDataTable extends DataTable
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

        $statuses = InvoiceStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];


        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Invoice $invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $invoice->id . '">';
            })
            ->editColumn('invoice_status_id', function (Invoice $invoice) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($statuses[$invoice->status_text]) . '">
                    '. trans('fi.' . strtolower($statuses[$invoice->status_text])) . '</span>';
                if ($invoice->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('fi.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('fi.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Invoice $invoice){
                return '<a href="/clients/' . $invoice->client->id . '">' . $invoice->client->name . '</a>';
            })
            ->orderColumn('formatted_invoice_date', 'invoice_date $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->rawColumns(['client.name', 'invoice_status_id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        return $model->has('client')->with('client')->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "invoices"; }'])
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters())
            ->parameters([
                'order' => [3, 'desc'],
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
            'invoice_status_id'  => [
                'title' => trans('fi.status'),
                'data' => 'invoice_status_id',
            ],
            'number' => [
                'title' => trans('fi.invoice'),
                'data' => 'number',
            ],
            'invoice_date'    => [
                'title' => trans('fi.date'),
                'data'       => 'formatted_invoice_date',
                'searchable' => false,
            ],
            'due_at'     => [
                'title' => trans('fi.due'),
                'data'       => 'formatted_due_at',
                'searchable' => false,
            ],
            'client_name'  => [
                'title' => trans('fi.client'),
                'data' => 'client.name',
            ],
            'summary' => [
                'title' => trans('fi.summary'),
                'data' => 'summary',
            ],
            /*'total'   => [
                'title' => trans('fi.total'),
                'data'       => 'amount.formatted_total',
                'orderable'  => false,
                'searchable' => false,
            ],
            'balance' => [
                'title' => trans('fi.balance'),
                'data'       => 'amount.formatted_balance',
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
        return 'Invoices_' . date('YmdHis');
    }
}
