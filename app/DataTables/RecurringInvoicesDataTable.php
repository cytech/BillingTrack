<?php

namespace BT\DataTables;

use BT\Modules\RecurringInvoices\Models\RecurringInvoice;
use BT\Support\Frequency;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class RecurringInvoicesDataTable extends DataTable
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

        return datatables()->eloquent($query)->addColumn('action', 'recurring_invoices._actions')
            ->editColumn('id', function (RecurringInvoice $recurring_invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $recurring_invoice->id . '">';
            })
            ->editColumn('number', function (RecurringInvoice $recurring_invoice) {
                return '<td class="hidden-xs">
                   <a href="recurring_invoices/' . $recurring_invoice->number . '/edit">' . $recurring_invoice->number . '</a></td>';
            })
            ->editColumn('client.id', function (RecurringInvoice $recurring_invoice) {
                return '<a href="/clients/' . $recurring_invoice->client->id . '">' . $recurring_invoice->client->unique_name . '</a>';
            })
            ->editColumn('recurring_frequency', function (RecurringInvoice $recurring_invoice) use ($frequencies) {
                return $recurring_invoice->recurring_frequency . ' ' . $frequencies[$recurring_invoice->recurring_period];
            })
            ->orderColumn('formatted_next_date', 'next_date $1')
            ->orderColumn('formatted_stop_date', 'stop_date $1')
            ->rawColumns(['number', 'client.id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param RecurringInvoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RecurringInvoice $model)
    {
        $models = $model->with(['client', 'activities', 'amount.recurringInvoice.currency'])->select('recurring_invoices.*', 'recurring_invoices.id as number')
            ->status(request('status'))
            ->clientId(request('client'))
            ->companyProfileId(request('company_profile'));

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
            ->orderBy(2, 'asc');
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
            Column::make('number')
                ->width('5%'),
            Column::make('client')
                ->name('client_id')
                ->title(trans('bt.client'))
                ->data('client.id'),
            Column::make('summary')
                ->title(trans('bt.summary'))
                ->data('formatted_summary'),
            Column::make('next_date')
                ->title(trans('bt.next_date'))
                ->data('formatted_next_date')
                ->searchable(false),
            Column::make('stop_date')
                ->title(trans('bt.stop_date'))
                ->data('formatted_stop_date')
                ->searchable(false),
            Column::make('every')
                ->title(trans('bt.every'))
                ->data('recurring_frequency')
                ->orderable(false)
                ->searchable(false),
            Column::make('total')
                ->name('amount.total')
                ->title(trans('bt.total'))
                ->data('amount.formatted_total')
                ->orderable(true)
                ->searchable(false),
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
        return 'RecurringInvoices_' . date('YmdHis');
    }
}
