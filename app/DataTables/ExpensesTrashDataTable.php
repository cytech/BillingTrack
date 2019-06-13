<?php

namespace BT\DataTables;

use BT\Modules\Expenses\Models\Expense;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ExpensesTrashDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'utilities._actions')
            ->editColumn('id', function (Expense $expense) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $expense->id . '">';
            })
           ->editColumn('formatted_amount', function (Expense $expense) {
               $ret = $expense->formatted_amount ;
                    if ($expense->is_billable)
                        if ($expense->has_been_billed)
                            $ret .= '<br><a href="'. route('invoices.edit', [$expense->invoice_id]) .'"><span class="badge badge-success">'. trans('fi.billed') .'</span></a>';
                         else
                            $ret .= '<br><span class="badge badge-danger">'. trans('fi.not_billed') .'</span>';
                    else
                            $ret .= '<br><span class="badge badge-secondary">'. trans('fi.not_billable') .'</span>';

                return $ret;

            })
            ->editColumn('category_name', function (Expense $expense) {
                $ret = $expense->category_name ;
                    if ($expense->vendor_name)
                    $ret .=  '<br><span class="text-muted">'. $expense->vendor_name .'</span>';

                return $ret;
            })
            ->editColumn('expense.attachments', function (Expense $expense){
                $ret = '';
                foreach ($expense->attachments as $attachment)
                     $ret .=  '<a href="'. $attachment->download_url .'"><i class="fa fa-file-o"></i> '. $attachment->filename .'</a><br>';

                return $ret;

            })
            ->orderColumn('formatted_expense_date', 'expense_date $1')
            ->orderColumn('formatted_description', 'description $1')
            ->rawColumns([ 'expense.attachments', 'category_name', 'formatted_amount', 'action', 'id']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \BT\User $model
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
            ->addAction(['width' => '80px'])
            //->parameters($this->getBuilderParameters())
            ->parameters([
                'order' => [1, 'desc'],
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
     * TODO problems with eloquent using getter on nested relation for ordering/search
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
            'expense_date' => [
                'title' => trans('fi.date'),
                'data' => 'formatted_expense_date',
                'searchable' => false,
            ],
            'category' => [
                    'title' => trans('fi.category'),
                    'data'       => 'category_name',
                    'searchable' => false,
                ],
            'description' => [
                'title' => trans('fi.description'),
                'data'       => 'formatted_description',
                'searchable' => false,
            ],
            'amount'   => [
                'name' => 'amount',
                'title' => trans('fi.amount'),
                'data'       => 'formatted_amount',
                'orderable' => true,
                'searchable' => false,
            ],
            'attachments'   => [
                'title' => trans('fi.attachments'),
                'data'       => 'expense.attachments',
                'orderable' => false,
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
        return 'Expenses_' . date('YmdHis');
    }
}
