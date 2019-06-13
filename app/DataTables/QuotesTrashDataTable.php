<?php

namespace BT\DataTables;

use BT\Modules\Quotes\Models\Quote;
use BT\Support\Statuses\QuoteStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class QuotesTrashDataTable extends DataTable
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

        $statuses = QuoteStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];


        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Quote $quote) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $quote->id . '">';
            })
            ->editColumn('quote_status_id', function (Quote $quote) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($statuses[$quote->status_text]) . '">
                    '. trans('fi.' . strtolower($statuses[$quote->status_text])) . '</span>';
                if ($quote->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('fi.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('fi.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('invoice_id', function (Quote $quote) {
                $ret = '<td class="hidden-xs">';
                if ($quote->invoice_id)
                    $ret .=  '<a href="'. route('invoices.edit', [$quote->invoice_id]) .'">'. trans('fi.invoice') .'</a>';
                elseif ($quote->workorder_id)
                    $ret .=  '<a href="'. route('workorders.edit', [$quote->workorder_id]) .'">'. trans('fi.workorder') .'</a>';
                else
                    $ret .= trans('fi.no');
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Quote $quote){
                return '<a href="/clients/' . $quote->client->id . '">' . $quote->client->name . '</a>';
            })
            ->orderColumn('formatted_quote_date', 'quote_date $1')
            ->orderColumn('formatted_expires_at', 'expires_at $1')
            ->rawColumns([ 'client.name', 'invoice_id', 'quote_status_id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quote $model)
    {
        return $model->has('client')->with('client')->where('invoice_id', 0)->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "quotes"; }'])
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
            'quote_status_id'  => [
                'title' => trans('fi.status'),
                'data' => 'quote_status_id',
            ],
            'number' => [
                'title' => trans('fi.quote'),
                'data' => 'number',
            ],
            'quote_date'    => [
                'title' => trans('fi.date'),
                'data'       => 'formatted_quote_date',
                'searchable' => false,
            ],
            'expires_at'     => [
                'title' => trans('fi.due'),
                'data'       => 'formatted_expires_at',
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
           /* 'amount'   => [
                'title' => trans('fi.total'),
                'data'       => 'amount.formatted_total',
                'orderable'  => false,
                'searchable' => false,
            ],*/
            'invoice_id' => [
                'title' => trans('fi.converted'),
                'data'       => 'invoice_id',
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
        return 'Quotes_' . date('YmdHis');
    }
}
