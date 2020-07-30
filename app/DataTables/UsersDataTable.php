<?php

namespace BT\DataTables;

use BT\Modules\Users\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', 'users._actions')
            ->editColumn('user_type', '{{ trans(\'bt.\' . $user_type)}}')
            ->editColumn('name', function (User $user) {
                return '<a href="/users/' . $user->id . '/edit/' . $user->user_type . '">' . $user->name . '</a>';
            })
            ->rawColumns(['name', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $models = $model->newQuery()->select('id', 'name', 'email', 'client_id')
            ->userType(request('userType'));

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
            ->orderBy(0, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make(trans('bt.name'))
                ->data('name'),
            Column::make(trans('bt.email'))
                ->data('email'),
            Column::make(trans('bt.type'))
                ->data('user_type')
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
        return 'Users_' . date('YmdHis');
    }
}
