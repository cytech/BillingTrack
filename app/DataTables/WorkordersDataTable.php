<?php

namespace BT\DataTables;

use BT\Modules\Workorders\Models\Workorder;
use BT\Support\Statuses\WorkorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class WorkordersDataTable extends DataTable
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

        return datatables()->eloquent($query)->addColumn('action', 'workorders._actions')
            ->editColumn('id', function (Workorder $workorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $workorder->id . '">';
            })
            ->editColumn('number', function (Workorder $workorder) {
                return '<a href="/workorders/' . $workorder->id . '/edit">' . $workorder->number . '</a>';
            })
            ->editColumn('workorder_status_id', function (Workorder $workorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($workorder->status_text) . '">
                    ' . $statuses[$workorder->status_text] . '</span>';
                if ($workorder->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('bt.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('bt.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('invoice_id', function (Workorder $workorder) {
                $ret = '<td class="hidden-xs">';
                if ($workorder->invoice()->count())
                    if ($workorder->invoice->status_text == 'canceled')
                        $ret .= '<span class="badge badge-canceled" title="' . trans('bt.canceled') . '" ><a href="' . route('invoices.edit', [$workorder->invoice_id]) . '"style="color: inherit;">' . trans('bt.invoice') . '</a></span>';
                    else
                        $ret .= '<span class="badge badge-info"><a href="' . route('invoices.edit', [$workorder->invoice_id]) . '"style="color: inherit;">' . trans('bt.invoice') . '</a></span>';
                elseif ($workorder->invoice()->withTrashed()->count())
                    $ret .= '<span class="badge badge-danger" title="Trashed"> <del>' . trans('bt.invoice') . '</del> </span>';

                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Workorder $workorder) {
                return '<a href="/clients/' . $workorder->client->id . '">' . $workorder->client->name . '</a>';
            })
            ->orderColumn('formatted_workorder_date', 'workorder_date $1')
            ->orderColumn('formatted_job_date', 'job_date $1')
            ->rawColumns(['client.name', 'invoice_id', 'workorder_status_id', 'number', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param Workorder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workorder $model)
    {
        $models = $model->with(['client', 'activities', 'amount.workorder.currency'])->select('workorders.*')
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
            ->orderBy(4, 'desc');
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
            Column::make('amount')
                ->name('amount.total')
                ->title(trans('bt.total'))
                ->data('amount.formatted_total')
                ->orderable(true)
                ->searchable(false),
            Column::make('invoice_id')
                ->title(trans('bt.converted'))
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
