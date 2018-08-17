<?php

namespace FI\DataTables;

use FI\Modules\Payments\Models\Payment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PaymentsTrashDataTable extends DataTable
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
           ->editColumn('invoice.number', function (Payment $payment) {
                return '<a href="/invoices/' . $payment->invoice_id . '/edit">' . $payment->invoice->number . '</a>';
            })
            ->editColumn('id', function (Payment $payment) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $payment->id . '">';
            })
            ->editColumn('invoice.client.name', function (Payment $payment) {
                return '<a href="clients/'.$payment->invoice->client->id .'/edit">'. $payment->invoice->client->name .'</a></td>';
            })
            ->orderColumn('formatted_paid_at', 'paid_at $1')
            ->orderColumn('formatted_amount', 'amount $1')
            ->rawColumns([ 'invoice.number','invoice.client.name', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->has('client')->has('invoice')->with('paymentMethod')->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "payments"; }'])
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters())
            ->parameters([
                'order' => [1, 'desc'],
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
     * TODO problems with eloquent using getter on nested relation for ordering/search
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
            'paid_at' => [
                'title' => trans('fi.payment_date'),
                'data' => 'formatted_paid_at',
                'searchable' => false,
            ],
            'invoice_number' => [
                    'title' => trans('fi.invoice'),
                    'data'       => 'invoice.number',
                ],
            'invoice_date' => [
                'title' => trans('fi.date'),
                'data'       => 'invoice.formatted_invoice_date',
                'orderable'  => false,
                'searchable' => false,
            ],
            'client_name'   => [
                'title' => trans('fi.client'),
                'data'       => 'invoice.client.name',
            ],
            'invoice_summary'   => [
                'title' => trans('fi.summary'),
                'data'       => 'invoice.summary',
            ],
            'amount'   => [
                'title' => trans('fi.amount'),
                'data'       => 'formatted_amount',
                'searchable' => false,
            ],
            'payment_method'  => [
                'title' => trans('fi.payment_method'),
                'name' => 'paymentMethod.name',
                'data' => 'payment_method.name',
                'searchable' => false,
            ],
            'note'    => [
                'title' => trans('fi.note'),
                'data'       => 'note',
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
        return 'Payments_' . date('YmdHis');
    }
}
