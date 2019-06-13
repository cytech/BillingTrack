<?php

namespace BT\DataTables;

use BT\Modules\Payments\Models\Payment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PaymentsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'payments._actions')
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
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->with(['invoice' => function ($q){$q->withTrashed();},
                             'invoice.client'=> function ($q){$q->withTrashed();}, 'invoice.currency', 'paymentMethod'])
            ->select('payments.*');
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
            ->parameters(['order' => [1, 'desc']]);
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
                'name' => 'invoice.invoice_date',
                'title' => trans('fi.invoice_date'),
                'data'       => 'invoice.formatted_invoice_date',
                'orderable'  => true,
                'searchable' => false,
            ],
            'client_name'   => [
                'title' => trans('fi.client'),
                'data'       => 'invoice.client.name',
            ],
            'invoice_summary'   => [
                'name' => 'invoice.summary',
                'title' => trans('fi.summary'),
                'data'       => 'invoice.formatted_summary',
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
