<?php

namespace BT\DataTables;

use BT\Modules\MailQueue\Models\MailQueue;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class MailQueueDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addColumn('action', 'mail_log._actions')
            ->editColumn('subject', function (MailQueue $mailq) {
                return '<a href="javascript:void(0)" class="btn-show-content" data-id="' . $mailq->id .'">'. $mailq->subject .'</a>';
            })
            ->rawColumns(['action', 'subject']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param MailQueue $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MailQueue $model)
    {
        $models = $model->newQuery();

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
            ->setTableId('mailqueue-table')
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
                ->hidden()
            ,
            Column::make('created_at')
                ->title(trans('bt.date'))
                ->data('formatted_created_at')
                ->searchable(false),
            Column::make('from')
                ->title(trans('bt.from'))
                ->data('formatted_from'),
            Column::make('to')
                ->title(trans('bt.to'))
                ->data('formatted_to'),
            Column::make('cc')
                ->title(trans('bt.cc'))
                ->data('formatted_cc'),
            Column::make('bcc')
                ->title(trans('bt.bcc'))
                ->data('formatted_bcc'),
            Column::make('subject')
                ->title(trans('bt.subject')),
            Column::make('sent')
                ->title(trans('bt.sent'))
                ->data('formatted_sent'),
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
        return 'MailQueue_' . date('YmdHis');
    }
}
