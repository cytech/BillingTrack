@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.recurring_events') }}</h1>
        <div class="pull-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-trash"><i
                        class="fa fa-trash"></i> {{ trans('fi.bulk_event_trash') }}</a>
            {{--<div class="btn-group">--}}
            {{--{!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}--}}
            {{--{!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'workorder_filter_options form-control ']) !!}--}}
            {{--{!! Form::close() !!}--}}
            {{--</div>--}}
            <a href="{!! route('scheduler.createrecurringevent') !!}" class="btn btn-primary "><i
                        class="fa fa-fw fa-plus"></i> {{ trans('fi.create_recurring_event') }}</a>
        </div>

        <div class="clearfix"></div>

    </section>
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i
                                    class="fa fa-fw fa-table fa-fw"></i> {{ trans('fi.recurring_table') }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table id="dt-filtertable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>
                                    <div class="btn-group"><input type="checkbox" id="bulk-select-all"></div>
                                </th>
                                <th>{{ trans('fi.title') }}</th>
                                <th>{{ trans('fi.description') }}</th>
                                <th>{{ trans('fi.start_date') }}</th>
                                <th>{{ trans('fi.frequency') }}</th>
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
                                    <td>{!! $event->occurrences()->first()->start_date !!}</td>
                                    <td>{!! $event->textTrans !!}</td>
                                    <td>{!! $event->category->name !!}</td>
                                    <td>
                                        <a class="btn btn-danger delete"
                                           onclick="deleteConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('scheduler.trashevent', [$event->id]) }}')"><i
                                                    class="fa fa-fw fa-trash-o"></i>{{ trans('fi.trash') }}</a>
                                        <a class="btn btn-primary iframe"
                                           href='{!! route("scheduler.editrecurringevent", [$event->id]) !!}'><i
                                                    class="fa fa-fw fa-edit"></i>{{ trans('fi.edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javascript')
    @include('partials._js_bulk_ajax')
@stop