<?php

namespace BT\DataTables;

use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Support\Statuses\PurchaseorderStatuses;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PurchaseordersDataTable extends DataTable
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

        $statuses = PurchaseorderStatuses::listsAllFlat() + ['overdue' => trans('bt.overdue')];


        return $dataTable->addColumn('action', 'purchaseorders._actions')
            ->editColumn('id', function (Purchaseorder $purchaseorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $purchaseorder->id . '">';
            })
            ->editColumn('number', function (Purchaseorder $purchaseorder) {
                return '<a href="/purchaseorders/' . $purchaseorder->id . '/edit">' . $purchaseorder->number . '</a>';
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
            ->editColumn('formatted_due_at', function (Purchaseorder $purchaseorder){
                if ($purchaseorder->isOverdue){
                    return '<span class="hidden-md hidden-sm hidden-xs" style="color: red; font-weight: bold;">' . $purchaseorder->formatted_due_at . '</span>';
                }
                    return $purchaseorder->formatted_due_at ;
            })
            ->editColumn('vendor.name', function (Purchaseorder $purchaseorder){
                return '<a href="/vendors/' . $purchaseorder->vendor->id . '">' . $purchaseorder->vendor->name . '</a>';
            })
            ->orderColumn('formatted_purchaseorder_date', 'purchaseorder_date $1')
            ->orderColumn('formatted_due_at', 'due_at $1')
            ->rawColumns(['vendor.name', 'formatted_due_at', 'purchaseorder_status_id', 'number', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchaseorder $model)
    {
        $models = $model->with(['vendor', 'activities', 'amount.purchaseorder.currency'])->select('purchaseorders.*')
            ->status(request('status'))
            ->vendorId(request('vendor'))
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
                'name' => 'summary',
                'title' => trans('bt.summary'),
                'data' => 'formatted_summary',
            ],
//            'total'   => [
//                'name' => 'amount.total',
//                'title' => trans('bt.total'),
//                'data'       => 'amount.formatted_total',
//                'orderable'  => true,
//                'searchable' => false,
//            ],
//            'balance' => [
//                'name' => 'amount.balance',
//                'title' => trans('bt.balance'),
//                'data'       => 'amount.formatted_balance',
//                'orderable'  => true,
//                'searchable' => false,
//            ],
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
