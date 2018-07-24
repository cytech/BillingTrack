@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <section class="content-header">
        <div class="container col-lg-12">
            @if(!($events->isEmpty()))
                <div class="row">
                    <div class="col-lg-12">
                        <a onclick="return pconfirm('{{ trans('fi.trash_restoreall_warning') }}','{!! route('workorders.restorealltrash') !!}')"
                           class="btn btn-success std-actions"><i class="fa fa-reply"></i> {{ trans('fi.trash_restoreall') }}</a>
                        <a onclick="return pconfirm('{{ trans('fi.trash_deleteall_warning') }}','{!! route('workorders.deletealltrash') !!}')"
                           class="btn btn-danger std-actions"><i class="fa fa-trash-o"></i> {{ trans('fi.trash_deleteall') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="javascript:void(0)" class="btn btn-success bulk-actions" id="btn-bulk-restore"><i
                                    class="fa fa-reply"></i> {{ trans('fi.trash_restoreselected') }}</a>

                        <a href="javascript:void(0)" class="btn btn-danger bulk-actions" id="btn-bulk-delete"><i
                                    class="fa fa-trash-o"></i> {{ trans('fi.trash_deleteselected') }}</a>
                    </div>
                </div>
                <br/>
            @endif
        </div>
    </section>
    <!-- /.row -->
    <section class="content">

        <div class="col-lg-12" ng-app="event" ng-controller="eventDeleteController">
            {{--<div class="col-lg-12">--}}
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-fw fa-table fa-fw"></i> {{ trans('fi.trash_table') }}</h3>
                </div>
                <div class="panel-body">
                    @include('trash._table')
                </div>
            </div>
            {{--</div>--}}
        </div>
    </section>

@stop
@section('javascript')
    {{--@include('partials._alerts')--}}
    {{--@include('partials._js_datatables')--}}
    @include('trash._js_eventDeleteController',['droute'=>'workorders.deletesingletrash','rroute'=>'workorders.restoresingletrash','pnote'=>'Trash Item'])
    <script>
        $(function () {
            $('#bulk-select-all').click(function () {
                if ($(this).prop('checked')) {
                    $('.bulk-record').prop('checked', true);
                    if ($('.bulk-record:checked').length > 0) {
                        $('.bulk-actions').show();
                        $('.std-actions').hide();
                    }
                }
                else {
                    $('.bulk-record').prop('checked', false);
                    $('.bulk-actions').hide();
                    $('.std-actions').show();
                }
            });

            $('.bulk-record').click(function () {
                if ($('.bulk-record:checked').length > 0) {
                    $('.bulk-actions').show();
                    $('.std-actions').hide();
                }
                else {
                    $('.bulk-actions').hide();
                    $('.std-actions').show();
                }
            });

            $('.bulk-actions').hide();


            $('#btn-bulk-delete').click(function () {
                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    pconfirm_def.text = '{{ trans('fi.trash_deleteselected_warning') }}';
                    new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                        $.post("{{ route('workorders.bulk.deletetrash') }}", {
                            ids: ids
                        }).done(function () {
                            $('input:checkbox').prop('checked', false);
                            $(ids).each(function (index, element) {
                                $("#" + element).hide();
                            });
                            $('.bulk-actions').hide();
                            $('.std-actions').show();
                            pnotify('{{ trans('fi.trash_delete_success') }}', 'success');
                        }).fail(function () {
                            pnotify('{{ trans('fi.unknown_error') }}', 'error');
                        });
                    }).on('pnotify.cancel', function () {
                        //Do Nothing
                    });
                }
            });
            $('#btn-bulk-restore').click(function () {
                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    pconfirm_def.text = '{{ trans('fi.trash_restoreselected_warning') }}';
                    new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                        $.post("{{ route('workorders.bulk.restoretrash') }}", {
                            ids: ids
                        }).done(function () {
                            $('input:checkbox').prop('checked', false);
                            $(ids).each(function (index, element) {
                                $("#" + element).hide();
                            });
                            $('.bulk-actions').hide();
                            $('.std-actions').show();
                            pnotify('{{ trans('fi.trash_restore_success') }}', 'success');
                        }).fail(function () {
                            pnotify('{{ trans('fi.unknown_error') }}', 'error');
                        });
                    }).on('pnotify.cancel', function () {
                        //Do Nothing
                    });
                }
            });
        });
    </script>
@stop