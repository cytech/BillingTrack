<?php

namespace BT\DataTables;

use BT\Modules\Payments\Models\Payment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class PaymentsDataTable extends DataTable
{
    protected $actions_blade = 'payments';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', $this->actions_blade.'._actions')
            ->editColumn('invoice.number', function (Payment $payment) {
                return '<a href="/invoices/' . $payment->invoice_id . '/edit">' . $payment->invoice->number . '</a>';
            })
            ->editColumn('id', function (Payment $payment) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $payment->id . '">';
            })
            ->editColumn('client.name', function (Payment $payment) {
                return '<a href="clients/' . $payment->client->id . '">' . $payment->client->name . '</a>';
            })
            ->orderColumn('formatted_paid_at', 'paid_at $1')
            ->orderColumn('formatted_amount', 'amount $1')
            ->rawColumns(['invoice.number', 'client.name', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->has('client')->has('invoice')->with('client', 'invoice','paymentMethod')->withTrashed();
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
            ->orderBy(1, 'desc');
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
            Column::make('paid_at')
                ->title(trans('bt.payment_date'))
                ->data('formatted_paid_at')
                ->searchable(false),
            Column::make('invoice_number')
                ->name('invoice.number')
                ->title(trans('bt.invoice'))
                ->data('invoice.number'),
            Column::make('invoice_date')
                ->name('invoice.invoice_date')
                ->title(trans('bt.invoice_date'))
                ->data('invoice.formatted_invoice_date')
                ->orderable(true)
                ->searchable(false),
            Column::make('client_name')
                ->name('client.name')
                ->title(trans('bt.client'))
                ->data('client.name'),
            Column::make('invoice_summary')
                ->name('invoice.summary')
                ->title(trans('bt.summary'))
                ->data('invoice.formatted_summary'),
            Column::make('amount')
                ->title(trans('bt.amount'))
                ->data('formatted_amount')
                ->searchable(false),
            Column::make('payment_method')
                ->title(trans('bt.payment_method'))
                ->name('paymentMethod.name')
                ->data('payment_method.name')
                ->searchable(false),
            Column::make('note')
                ->title(trans('bt.note')),
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
        return 'Payments_' . date('YmdHis');
    }
}
