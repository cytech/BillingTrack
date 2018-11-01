@extends('layouts.master')

@section('content')
    <section class="container-fluid m-2">
        <h3 class="float-left">{{ trans('fi.events') }}</h3>
        <div class="float-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-trash"><i
                        class="fa fa-trash"></i> {{ trans('fi.bulk_event_trash') }}</a>
            <a href="{!! route('scheduler.tableeventcreate') !!}" class="btn btn-primary "><i
                        class="fa fa-fw fa-plus"></i> {{ trans('fi.create_event') }}</a>
        </div>

        <div class="clearfix"></div>

    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">

                    <div class="card-body no-padding">
                        @include('partials._dataTable')
                        {{--<table id="dt-filtertable" class="display" cellspacing="0" width="100%">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>--}}
                                {{--<th>{{ trans('fi.title') }}</th>--}}
                                {{--<th>{{ trans('fi.description') }}</th>--}}
                                {{--<th>{{ trans('fi.start_date') }}</th>--}}
                                {{--<th>{{ trans('fi.end_date') }}</th>--}}
                                {{--<th>{{ trans('fi.category') }}</th>--}}
                                {{--<th>Action</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($events as $event)--}}
                                {{--<tr id="{!! $event->id !!}">--}}
                                    {{--<td><input type="checkbox" class="bulk-record" data-id="{{ $event->id }}"></td>--}}
                                    {{--<td>{!! $event->title !!}</td>--}}
                                    {{--<td>{!! str_limit(strip_tags($event->description),25) !!}</td>--}}
                                    {{--<td>{!! $event->start_date !!}</td>--}}
                                    {{--<td>{!! $event->end_date !!}</td>--}}
                                    {{--<td>{!! $event->category->name !!}</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="btn btn-outline-primary" href ="{{ route('scheduler.tableeventedit', [$event->id]) }}"><i--}}
                                                    {{--class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>--}}
                                        {{--<a class="btn btn-outline-danger" href ="#"--}}
                                           {{--onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('scheduler.trashevent', [$event->id]) }}');"><i--}}
                                                    {{--class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@stop
@section('javascript')
    @include('partials._js_bulk_ajax')
    {{--@include('partials._js_datatables')--}}
@stop