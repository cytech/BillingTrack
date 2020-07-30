<?php

namespace BT\DataTables;

use BT\Modules\Payments\Models\Payment;

class PaymentsTrashDataTable extends PaymentsDataTable
{
    protected $actions_blade = 'utilities';

    /**
     * Get query source of dataTable.
     *
     * @param Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->has('client')->has('invoice')->with('client', 'invoice','paymentMethod')->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "payments"; }'])
            ->orderBy(1, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }
}
