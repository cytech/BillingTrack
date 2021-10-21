<?php

namespace BT\DataTables;

use BT\Modules\Quotes\Models\Quote;
use BT\Support\Statuses\QuoteStatuses;

class QuotesTrashDataTable extends QuotesDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $statuses = QuoteStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];

        return datatables()->eloquent($query)->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Quote $quote) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $quote->id . '">';
            })
            ->editColumn('quote_status_id', function (Quote $quote) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($quote->status_text) . '">
                    '. $statuses[$quote->status_text] . '</span>';
                if ($quote->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('bt.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('bt.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('invoice_id', function (Quote $quote) {
                $ret = '<td class="hidden-xs">';
                if ($quote->invoice_id)
                    $ret .= '<a href="' . route('invoices.edit', [$quote->invoice_id]) . '">' . trans('bt.invoice') . '</a>';
                elseif ($quote->workorder_id)
                    $ret .= '<a href="' . route('workorders.edit', [$quote->workorder_id]) . '">' . trans('bt.workorder') . '</a>';
                else
                    $ret .= trans('bt.no');
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Quote $quote) {
                return '<a href="/clients/' . $quote->client->id . '">' . $quote->client->name . '</a>';
            })
            ->orderColumn('formatted_quote_date', 'quote_date $1')
            ->orderColumn('formatted_expires_at', 'expires_at $1')
            ->rawColumns([ 'client.name', 'invoice_id', 'quote_status_id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param Quote $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quote $model)
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
            ->removeColumn('amount.total')
            ->ajax(['data' => 'function(d) { d.table = "quotes"; }'])
            ->orderBy(3, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
