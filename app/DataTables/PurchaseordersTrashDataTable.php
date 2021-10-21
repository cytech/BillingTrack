<?php

namespace BT\DataTables;

use BT\Modules\Purchaseorders\Models\Purchaseorder;
use BT\Support\Statuses\PurchaseorderStatuses;

class PurchaseordersTrashDataTable extends PurchaseordersDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $statuses = PurchaseorderStatuses::listsAllFlat();

        return datatables()->eloquent($query)->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Purchaseorder $purchaseorder) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $purchaseorder->id . '">';
            })
            ->editColumn('purchaseorder_status_id', function (Purchaseorder $purchaseorder) use ($statuses) {
                $ret = '<td class="hidden-sm hidden-xs">
                <span class="badge badge-' . strtolower($purchaseorder->status_text) . '">
                    '. $statuses[$purchaseorder->status_text] . '</span>';
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
     * @param Purchaseorder $model
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
            ->removeColumn('amount.balance')
            ->removeColumn('amount.total')
            ->ajax(['data' => 'function(d) { d.table = "purchaseorders"; }'])
            ->orderBy(3, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
