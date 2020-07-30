<?php

namespace BT\DataTables;

use BT\Modules\Expenses\Models\Expense;

class ExpensesTrashDataTable extends ExpensesDataTable
{
    protected $actions_blade = 'utilities';

    /**
     * Get query source of dataTable.
     *
     * @param Expense $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
    {
        return $model->defaultQuery()
            ->categoryId(request('category'))
            ->vendorId(request('vendor'))
            ->status(request('status'))
            ->companyProfileId(request('company_profile'))
            ->onlyTrashed();
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
            ->ajax(['data' => 'function(d) { d.table = "expenses"; }'])
            ->orderBy(1, 'desc')
            ->lengthMenu([
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ]);
    }

}
