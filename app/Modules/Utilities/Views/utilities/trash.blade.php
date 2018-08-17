@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.manage_trash') }}
        </h1>
        <div class="pull-right">
            <a href="javascript:void(0)" class="btn btn-warning bulk-actions" id="btn-bulk-restore"><i class="fa fa-edit"></i> {{ trans('fi.trash_restoreselected') }}</a>
            <a href="javascript:void(0)" class="btn btn-danger bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> {{ trans('fi.trash_deleteselected') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-clients">{{ trans('fi.clients') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-quotes">{{ trans('fi.quotes') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-workorders">{{ trans('fi.workorders') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-invoices">{{ trans('fi.invoices') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-recurring_invoices">{{ trans('fi.recurring_invoices') }}</a>
                        </li>
                        <li><a data-toggle="tab" href="#tab-payments">{{ trans('fi.payments') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-expenses">{{ trans('fi.expenses') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-projects">{{ trans('fi.projects') }}</a></li>
                        <li><a data-toggle="tab" href="#tab-schedule">{{ trans('fi.scheduler') }}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-clients" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $ctdt->html()->table(['id' => 'Client', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-quotes" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $qtdt->html()->table(['id' => 'Quote', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-workorders" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $wtdt->html()->table(['id' => 'Workorder', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-invoices" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $itdt->html()->table(['id' => 'Invoice', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-recurring_invoices" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $ritdt->html()->table(['id' => 'RecurringInvoice', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-payments" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $pytdt->html()->table(['id' => 'Payment', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-expenses" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $etdt->html()->table(['id' => 'Expense', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-projects" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $pjtdt->html()->table(['id' => 'TimeTrackingProject', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-schedule" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $stdt->html()->table(['id' => 'Schedule', 'width' => '100%']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('scripts')
    {!! $ctdt->html()->scripts() !!}
    {!! $qtdt->html()->scripts() !!}
    {!! $wtdt->html()->scripts() !!}
    {!! $itdt->html()->scripts() !!}
    {!! $ritdt->html()->scripts() !!}
    {!! $pytdt->html()->scripts() !!}
    {!! $etdt->html()->scripts() !!}
    {!! $pjtdt->html()->scripts() !!}
    {!! $stdt->html()->scripts() !!}

    <script>
        var htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>

    <script type="text/javascript">
        $(function() {
            $('#btn-bulk-restore').click(function () {
                var ids = [];

                $('.bulk-record:checked').each(function () {
                    var entity = $(this).closest('table').attr('id');
                    var id = $(this).data('id');
                    ids.push({[entity] : id});
                });

                if (ids.length > 0) {
                    bulkConfirm('{!! trans('fi.trash_restoreselected_warning') !!}', "{{ route('utilities.bulk.restoretrash') }}",  ids);
                }
            });
            $('#btn-bulk-delete').click(function () {
                var ids = [];

                $('.bulk-record:checked').each(function () {
                    var entity = $(this).closest('table').attr('id');
                    var id = $(this).data('id');
                    ids.push({[entity] : id});
                });

                if (ids.length > 0) {
                    bulkConfirm('{!! trans('fi.bulk_delete_record_warning') !!}', "{{ route('utilities.bulk.deletetrash') }}",  ids);
                }
            });
        });
    </script>
@endpush

