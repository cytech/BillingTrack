<?php

namespace BT\DataTables;

use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Support\Statuses\PurchaseorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PurchaseordersTrashDataTable extends DataTable
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

        $statuses = PurchaseorderStatuses::listsAllFlat();// + ['overdue' => trans('bt.overdue')];


        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Purchaseorder $purchaseorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $purchaseorder->id . '">';
            })
            ->editColumn('purchaseorder_status_id', function (Purchaseorder $purchaseorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($statuses[$purchaseorder->status_text]) . '">
                    '. trans('bt.' . strtolower($statuses[$purchaseorder->status_text])) . '</span>';
                if ($purchaseorder->viewed)
                    $ret .= '<span class="badge badge-success">' . trans('bt.viewed') . '</span>';
                else
                    $ret .= '<span class="badge badge-secondary">' . trans('bt.not_viewed') . '</span>';
                $ret .= '</td>';

                return $ret;
            })
            ->editColumn('vendor.name', function (Purchaseorder $purchaseorder){
                return '<a href="/vendors/' . $purchaseorder->vendor->id . '">' . $purchaseorder->vendor->name . '</a>';
            })
            ->orderColumn('formatted_purchaseorder_date', 'purchaseorder_date $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->rawColumns(['vendor.name', 'purchaseorder_status_id', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchaseorder $model)
    {
        return $model->has('vendor')->with('vendor')->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "purchaseorders"; }'])
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
            'purchaseorder_status_id'  => [
                'title' => trans('bt.status'),
                'data' => 'purchaseorder_status_id',
            ],
            'number' => [
                'title' => trans('bt.purchaseorder'),
                'data' => 'number',
            ],
            'purchaseorder_date'    => [
                'title' => trans('bt.date'),
                'data'       => 'formatted_purchaseorder_date',
                'searchable' => false,
            ],
            'due_at'     => [
                'title' => trans('bt.due'),
                'data'       => 'formatted_due_at',
                'searchable' => false,
            ],
            'vendor_name'  => [
                'title' => trans('bt.vendor'),
                'data' => 'vendor.name',
            ],
            'summary' => [
                'title' => trans('bt.summary'),
                'data' => 'summary',
            ],
            /*'total'   => [
                'title' => trans('bt.total'),
                'data'       => 'amount.formatted_total',
                'orderable'  => false,
                'searchable' => false,
            ],
            'balance' => [
                'title' => trans('bt.balance'),
                'data'       => 'amount.formatted_balance',
                'orderable'  => false,
                'searchable' => false,
            ],*/
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Purchaseorders_' . date('YmdHis');
    }
}
