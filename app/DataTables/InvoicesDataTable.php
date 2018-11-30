<?php

namespace FI\DataTables;

use FI\Modules\Invoices\Models\Invoice;
use FI\Support\Statuses\InvoiceStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        $statuses = InvoiceStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];


        return $dataTable->addColumn('action', 'invoices._actions')
            ->editColumn('id', function (Invoice $invoice) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $invoice->id . '">';
            })
            ->editColumn('number', function (Invoice $invoice) {
                return '<a href="/invoices/' . $invoice->id . '/edit">' . $invoice->number . '</a>';
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
            ->editColumn('formatted_due_at', function (Invoice $invoice){
                if ($invoice->isOverdue){
                    return '<span class="hidden-md hidden-sm hidden-xs" style="color: red; font-weight: bold;">' . $invoice->formatted_due_at . '</span>';
                }
                    return $invoice->formatted_due_at ;
            })
            ->editColumn('client.name', function (Invoice $invoice){
                return '<a href="/clients/' . $invoice->client->id . '">' . $invoice->client->name . '</a>';
            })
            ->orderColumn('formatted_invoice_date', 'invoice_date $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->rawColumns(['client.name', 'formatted_due_at', 'invoice_status_id', 'number', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
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
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters());
            ->parameters(['order' => [3, 'desc']]);
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
                'data' => 'formatted_summary',
            ],
            'total'   => [
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
        return 'Invoices_' . date('YmdHis');
    }
}
