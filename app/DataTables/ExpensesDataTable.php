<?php

namespace BT\DataTables;

use BT\Modules\Expenses\Models\Expense;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class ExpensesDataTable extends DataTable
{
    protected $actions_blade = 'expenses';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', $this->actions_blade.'._actions')
            ->editColumn('id', function (Expense $expense) {
                return '<input type="checkbox" class="bulk-record" data-id="' . $expense->id . '">';
            })
            ->editColumn('formatted_amount', function (Expense $expense) {
                $ret = $expense->formatted_amount;
                if ($expense->is_billable)
                    if ($expense->has_been_billed)
                        $ret .= '<br><a href="' . route('invoices.edit', [$expense->invoice_id]) . '"><span class="badge badge-success">' . trans('bt.billed') . '</span></a>';
                    else
                        $ret .= '<br><span class="badge badge-danger">' . trans('bt.not_billed') . '</span>';
                else
                    $ret .= '<br><span class="badge badge-secondary">' . trans('bt.not_billable') . '</span>';

                return $ret;

            })
            ->editColumn('category_name', function (Expense $expense) {
                $ret = $expense->category_name;
                if ($expense->vendor_name)
                    $ret .= '<br><span class="text-muted">' . $expense->vendor_name . '</span>';

                return $ret;
            })
            ->editColumn('expense.attachments', function (Expense $expense) {
                $ret = '';
                foreach ($expense->attachments as $attachment)
                    $ret .= '<a href="' . $attachment->download_url . '"><i class="fa fa-file-o"></i> ' . $attachment->filename . '</a><br>';

                return $ret;

            })
            ->orderColumn('formatted_expense_date', 'expense_date $1')
            ->orderColumn('formatted_description', 'description $1')
            ->rawColumns(['expense.attachments', 'category_name', 'formatted_amount', 'action', 'id']);
    }


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
            ->companyProfileId(request('company_profile'));
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
            ->orderBy(1, 'desc');
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
            Column::make('expense_date')
                ->title(trans('bt.date'))
                ->data('formatted_expense_date')
                ->searchable(false),
            Column::make('category')
                ->title(trans('bt.category'))
                ->name('category_name')
                ->data('category_name')
                ->searchable(false),
            Column::make('description')
                ->title(trans('bt.description'))
                ->data('formatted_description')
                ->searchable(true),
            Column::make('amount')
                ->title(trans('bt.amount'))
                ->data('formatted_amount')
                ->orderable(true)
                ->searchable(false),
            Column::make('attachments')
                ->title(trans('bt.attachments'))
                ->data('expense.attachments')
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
        return 'Expenses_' . date('YmdHis');
    }
}
