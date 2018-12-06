<?php

namespace FI\DataTables;

use FI\Modules\Users\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action','users._actions')
                         ->editColumn('user_type', '{{ trans(\'fi.\' . $user_type)}}')
                         ->editColumn('name', function(User $user){
                             return '<a href="/users/'. $user->id .'/edit/'. $user->user_type .'">'.$user->name . '</a>';
                         })
                         ->rawColumns(['name', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \FI\User $model
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
                    ->addAction(['width' => '80px'])
                    ->parameters(['order' => [0, 'asc']]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            trans('fi.name')=> [
                'data' => 'name',
            ],
            trans('fi.email')=> [
                'data' => 'email',
            ],
            trans('fi.type')=> [
                'data' => 'user_type',
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
        return 'Users_' . date('YmdHis');
    }
}
