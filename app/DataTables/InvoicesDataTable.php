<?php

namespace BT\DataTables;

use BT\Modules\Invoices\Models\Invoice;
use BT\Support\Statuses\InvoiceStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class InvoicesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $statuses = InvoiceStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];

        return datatables()->eloquent($query)->addColumn('action', 'invoices._actions')
            ->editColumn('id', function (Invoice $invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $invoice->id . '">';
            })
            ->editColumn('number', function (Invoice $invoice) {
                return '<a href="/invoices/' . $invoice->id . '/edit">' . $invoice->number . '</a>';
            })
            ->editColumn('invoice_status_id', function (Invoice $invoice) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($invoice->status_text) . '">
                    ' . $statuses[$invoice->status_text] . '</span>';
                if ($invoice->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('bt.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('bt.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('formatted_due_at', function (Invoice $invoice) {
                if ($invoice->isOverdue) {
                    return '<span class="hidden-md hidden-sm hidden-xs" style="color: red; font-weight: bold;">' . $invoice->formatted_due_at . '</span>';
                }
                return $invoice->formatted_due_at;
            })
            ->editColumn('client.name', function (Invoice $invoice) {
                return '<a href="/clients/' . $invoice->client->id . '">' . $invoice->client->name . '</a>';
            })
            ->orderColumn('formatted_invoice_date', 'invoice_date $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->rawColumns(['client.name', 'formatted_due_at', 'invoice_status_id', 'number', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        $models = $model->with(['client', 'activities', 'amount.invoice.currency'])->select('invoices.*')
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
            ->orderBy(3, 'desc');
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
                ->className('bulk-record'),
            Column::make('invoice_status_id')
                ->title(trans('bt.status')),
            Column::make('number')
                ->title(trans('bt.invoice')),
            Column::make('invoice_date')
                ->title(trans('bt.date'))
                ->data('formatted_invoice_date')
                ->searchable(false),
            Column::make('due_at')
                ->title(trans('bt.due'))
                ->data('formatted_due_at')
                ->searchable(false),
            Column::make('client_name')
                ->name('client.name')
                ->title(trans('bt.client'))
                ->data('client.name'),
            Column::make('summary')
                ->title(trans('bt.summary'))
                ->data('formatted_summary'),
            Column::make('total')
                ->title(trans('bt.total'))
                ->name('amount.total')
                ->data('amount.formatted_total')
                ->orderable(true)
                ->searchable(false),
            Column::make('balance')
                ->title(trans('bt.balance'))
                ->name('amount.balance')
                ->data('amount.formatted_balance')
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
        return 'Invoices_' . date('YmdHis');
    }
}
