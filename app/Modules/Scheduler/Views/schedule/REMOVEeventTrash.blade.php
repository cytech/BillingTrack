@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <div class="container col-lg-12">
        @if(!($events->isEmpty()))
            <div class="row">
                <div class="col-lg-12">
                    <a onclick="return pconfirm('{{ trans('fi.trash_restoreall_warning') }}','{!! route('scheduler.restorealltrash') !!}')"
                       class="btn btn-success std-actions"><i class="fa fa-reply"></i> {{ trans('fi.trash_restoreall') }}</a>
                    <a onclick="return pconfirm('{{ trans('fi.trash_deleteall_warning') }}','{!! route('scheduler.deletealltrash') !!}')"
                       class="btn btn-danger std-actions"><i class="fa fa-trash-o"></i> {{ trans('fi.trash_deleteall') }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="javascript:void(0)" class="btn btn-success bulk-actions" id="btn-bulk-restore"><i
                                class="fa fa-reply"></i> {{ trans('fi.trash_restoreselected') }}</a>

                    <a href="javascript:void(0)" class="btn btn-danger bulk-actions" id="btn-bulk-trash"><i
                                class="fa fa-trash-o"></i> {{ trans('fi.trash_deleteselected') }}</a>
                </div>
            </div>
            <br/>
    @endif
    </div>
    <!-- /.row -->
        <div class="row" ng-app="event" ng-controller="eventDeleteController">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-fw fa-table fa-fw"></i> {{ trans('fi.event_trash') }}</h3>
                    </div>
                    <div class="panel-body">
                        <table id="dt-filtertable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
                                <th>{{ trans('fi.title') }}</th>
                                <th>{{ trans('fi.description') }}</th>
                                <th>{{ trans('fi.start_date') }}</th>
                                <th>{{ trans('fi.end_date') }}</th>
                                <th>{{ trans('fi.category') }}</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr id="{!! $event->id !!}">
                                    <td><input type="checkbox" class="bulk-record" data-id="{{ $event->id }}"></td>
                                    <td>{!! $event->title !!}</td>
                                    <td>{!! str_limit(strip_tags($event->description),25) !!}</td>
                                    <td>{!! $event->occurrences->first()->start_date !!}</td>
                                    <td>{!! $event->occurrences->first()->end_date !!}</td>
                                    <td>{!! $event->category->name !!}</td>
                                    <td>
                                        <a class="btn btn-success delete" ng-click="restore({!! $event->id !!})"><i
                                                    class="fa fa-fw fa-reply"></i>{{ trans('fi.restore') }}</a>
                                        <a class="btn btn-danger delete" ng-click="delete({!! $event->id !!})"><i
                                                    class="fa fa-fw fa-trash-o"></i>{{ trans('fi.delete') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    @include('partials._js_eventDeleteController',
    ['droute'=>'scheduler.deletesingletrash','rroute'=>'scheduler.restoresingletrash',
    'pnote'=>trans('fi.deleted_success'),
    'pCnote'=>trans('fi.trash_deletesingle_warning')])
    @include('partials._js_bulk_ajax',
    ['droute'=>'scheduler.bulk.deletetrash','rroute'=>'scheduler.bulk.restoretrash',
    'pnote'=>trans('fi.trash_delete_success'),
    'pCnote'=>trans('fi.trash_deleteselected_warning')])
    <script>
        $(function () {
            $('#btn-bulk-restore').click(function () {
                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    pconfirm_def.text = '{{ trans('fi.trash_restoreselected_warning') }}';
                    new PNotify(pconfirm_def).get().on('pnotify.confirm', function () {
                        $.post("{{ route('scheduler.bulk.restoretrash') }}", {
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