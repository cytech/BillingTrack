<?php

namespace BT\DataTables;

use BT\Modules\Workorders\Models\Workorder;
use BT\Support\Statuses\WorkorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class WorkordersTrashDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $statuses = WorkorderStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];

        return datatables()->eloquent($query)->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Workorder $workorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $workorder->id . '">';
            })
            ->editColumn('workorder_status_id', function (Workorder $workorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($statuses[$workorder->status_text]) . '">
                    ' . trans('bt.' . strtolower($statuses[$workorder->status_text])) . '</span>';
                if ($workorder->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('bt.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('bt.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('invoice_id', function (Workorder $workorder) {
                $ret = '<td class="hidden-xs">';
                if ($workorder->invoice_id)
                    $ret .= '<a href="' . route('invoices.edit', [$workorder->invoice_id]) . '">' . trans('bt.yes') . '</a>';
                else
                    $ret .= trans('bt.no');
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Workorder $workorder) {
                return '<a href="/clients/' . $workorder->client->id . '">' . $workorder->client->name . '</a>';
            })
            ->orderColumn('formatted_workorder_date', 'workorder_date $1')
            ->orderColumn('formatted_job_date', 'job_date $1')
            ->rawColumns(['client.name', 'invoice_id', 'workorder_status_id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param Workorder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workorder $model)
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
            ->ajax(['data' => 'function(d) { d.table = "workorders"; }'])
            ->orderBy(3, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
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
            Column::make('id')
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->className('bulk-record')
            ,
            Column::make('workorder_status_id')
                ->title(trans('bt.status'))
                ->data('workorder_status_id'),
            Column::make('number')
                ->title(trans('bt.workorder'))
                ->data('number'),
            Column::make('workorder_date')
                ->title(trans('bt.date'))
                ->data('formatted_workorder_date')
                ->searchable(false),
            Column::make('job_date')
                ->title(trans('bt.job_date'))
                ->data('formatted_job_date')
                ->searchable(false),
            Column::make('client_name')
                ->name('client.name')
                ->title(trans('bt.client'))
                ->data('client.name'),
            Column::make('summary')
                ->title(trans('bt.summary'))
                ->data('formatted_summary'),
            Column::make('invoice_id')
                ->title(trans('bt.invoiced'))
                ->data('invoice_id')
                ->orderable(false)
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
        return 'Workorders_' . date('YmdHis');
    }
}
