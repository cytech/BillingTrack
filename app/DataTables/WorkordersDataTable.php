<?php

namespace BT\DataTables;

use BT\Modules\Workorders\Models\Workorder;
use BT\Support\Statuses\WorkorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        $statuses = WorkorderStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];


        return $dataTable->addColumn('action', 'workorders._actions')
            ->editColumn('id', function (Workorder $workorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $workorder->id . '">';
            })
            ->editColumn('number', function (Workorder $workorder) {
                return '<a href="/workorders/' . $workorder->id . '/edit">' . $workorder->number . '</a>';
            })
            ->editColumn('workorder_status_id', function (Workorder $workorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($statuses[$workorder->status_text]) . '">
                    '. trans('fi.' . strtolower($statuses[$workorder->status_text])) . '</span>';
                if ($workorder->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('fi.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('fi.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('invoice_id', function (Workorder $workorder) {
                $ret = '<td class="hidden-xs">';
                if ($workorder->invoice_id)
                    $ret .=  '<a href="'. route('invoices.edit', [$workorder->invoice_id]) .'">'. trans('fi.yes') .'</a>';
                else
                    $ret .= trans('fi.no');
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('client.name', function (Workorder $workorder){
                return '<a href="/clients/' . $workorder->client->id . '">' . $workorder->client->name . '</a>';
            })
            ->orderColumn('formatted_workorder_date', 'workorder_date $1')
            ->orderColumn('formatted_job_date', 'job_date $1')
            ->rawColumns([ 'client.name', 'invoice_id', 'workorder_status_id', 'number', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
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
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters());
            ->parameters(['order' => [4, 'desc']]);
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
            'workorder_status_id'  => [
                'title' => trans('fi.status'),
                'data' => 'workorder_status_id',
            ],
            'number' => [
                'title' => trans('fi.workorder'),
                'data' => 'number',
            ],
            'workorder_date'    => [
                'title' => trans('fi.date'),
                'data'       => 'formatted_workorder_date',
                'searchable' => false,
            ],
            'job_date'     => [
                'title' => trans('fi.job_date'),
                'data'       => 'formatted_job_date',
                'searchable' => false,
            ],
            'client_name'  => [
                'title' => trans('fi.client'),
                'data' => 'client.name',
            ],
            'summary' => [
                'name' => 'summary',
                'title' => trans('fi.summary'),
                'data' => 'formatted_summary',
            ],
            'amount'   => [
                'name' => 'amount.total',
                'title' => trans('fi.total'),
                'data'       => 'amount.formatted_total',
                'orderable'  => true,
                'searchable' => false,
            ],
            'invoice_id' => [
                'title' => trans('fi.invoiced'),
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
        return 'Workorders_' . date('YmdHis');
    }
}
