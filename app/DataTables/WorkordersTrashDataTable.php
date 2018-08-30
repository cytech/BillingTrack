<?php

namespace FI\DataTables;

use FI\Modules\Workorders\Models\Workorder;
use FI\Support\Statuses\WorkorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        $statuses = WorkorderStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')];


        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Workorder $workorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $workorder->id . '">';
            })
            ->editColumn('workorder_status_id', function (Workorder $workorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="label label-' . strtolower($statuses[$workorder->status_text]) . '">
                    '. trans('fi.' . strtolower($statuses[$workorder->status_text])) . '</span>';
                if ($workorder->viewed)
                    $ret .= '<span class="label label-success">' . trans('fi.viewed') . '</span>';
                else
                    $ret .= '<span class="label label-default">' . trans('fi.not_viewed') . '</span>';
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
            ->orderColumn('formatted_expires_at', 'expires_at $1')
            ->rawColumns([ 'client.name', 'invoice_id', 'workorder_status_id',  'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
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
