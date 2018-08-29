@extends('layouts.master')


@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    <div class="container col-lg-12">
        <div class="row" ng-app="event" ng-controller="recurringEventController">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i
                                    class="fa fa-edit fa-fw"></i> {{ trans('fi.'.$title) }}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($schedule,['id' => 'event', 'accept-charset' => 'utf-8', 'class' => 'form-horizontal',  'ng-submit'=>'create($event)']) !!}
                        {!! Form::hidden('id') !!}
                        {!! Form::hidden('oid') !!}
                        {{--{!! Form::hidden('public_id') !!}--}}
                        <div class="form-group">
                            {!! Form::label('title',trans('fi.title'),['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title',null,['class'=>'form-control']) !!}
                            </div>
                            <script>
                                $("#title").autocomplete({
                                    appendTo: "#event",
                                    source: "/scheduler/ajax/employee",
                                    minLength: 2
                                }).autocomplete("widget").addClass("fixed-height");
                            </script>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description',trans('fi.description'),['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('description',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id',trans('fi.category'),['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('category_id',$categories,null, ['id' => 'category_id','class'=>'form-control']) !!}
                            </div>
                        </div>

                        @include('partials._rrule_editdialog')

                        @if(!$schedule->reminders->isEmpty())
                            @foreach($schedule->reminders as $reminder)
                                <div class="reminder_delete_div">
                                    <div class="form-group">
                                        <hr class="col-sm-8 width60 hr-clr-green"/>
                                        <span class="col-sm-1 pull-left reminder-cross-table delete_reminder"
                                              style="cursor: pointer"><i class="fa fa-times-circle"></i> </span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reminder_date',trans('fi.reminder_date'),['for'=>'reminder_date', 'class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::input('text','reminder_date[]',$reminder->reminder_date, ['class'=>'form-control reminder_date','style'=>'cursor: pointer','readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reminder_location',trans('fi.reminder_location'),['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('reminder_location[]',$reminder->reminder_location,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reminder_text',trans('fi.reminder_text'),['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('reminder_text[]',$reminder->reminder_text,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div id="addReminderShow">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="addReminderCreate"
                                        class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('fi.add_reminder') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <a class="btn btn-warning btn-lg" href={!! URL::previous()  !!}>{{ trans('fi.cancel') }} <span
                        class="glyphicon glyphicon-remove-circle"></span></a>
            <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.'.$title) }} <span
                        class="glyphicon glyphicon-floppy-disk"></span></button>
            {{--        {!! Button::normal(trans('texts.cancel'))
                            ->large()
                            ->asLinkTo(URL::previous())
                            ->appendIcon(Icon::create('remove-circle')) !!}

                    {!! Button::success($title)
                            ->submit()
                            ->large()
                            ->appendIcon(Icon::create('floppy-disk')) !!}--}}
        </div>

        {!! Form::close() !!}

        <div class="addReminderView" style="display: none">
            @include('partials._reminderdiv')
        </div>

    </div>
@stop
@section('javascript')
    @include('partials._js_datetimepicker')
    <script type="text/javascript">

        $(function () {
            $(".warn-on-exit input").first().focus();
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#addReminderCreate").click(function (event) {
                event.preventDefault();
                $("#addReminderCreate").html('<i class="fa fa-plus"></i> {{ trans('fi.add_another_reminder') }}');
                $("#addReminderShow").append($(".addReminderView").html());
            });
            //changed on focus to mousedown. was taking 2 clicks
            $(document).on('mousedown', '.reminder_date', function () {
                $(this).datetimepicker({
                    format: 'Y-m-d H:i',
                    defaultDate: '+1970/01/08' //plus 1 week
                });
            });

            $(document).on('click', '.delete_reminder', function () {
                $(this).parent().parent().remove();
            });
        });
        var event = angular.module('event', [], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('{dfh');
            $interpolateProvider.endSymbol('dfh}');
        });
        event.controller('recurringEventController', function ($scope, $http) {
            $scope.create = function (event) {
                event.preventDefault();
                var data = $("#event").serializeArray();
                //format checkbox arrays properly for rrule
                data.push({
                    name: "byday",
                    value: $("#byday:checked").map(function () {
                        return $(this).val().toString();
                    }).get().join(","),
                });
                data.push({
                    name: "bymonth",
                    value: $("#bymonth:checked").map(function () {
                        return $(this).val().toString();
                    }).get().join(",")
                });

                var req = {
                    method: 'POST',
                    url: "{!! route('scheduler.updaterecurringevent') !!}",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                };

                $http(req).then(function (response) {
                    if (response.data.type === 'success') {
                        notify('{{trans('fi.'.$message)}}', 'success');
                        setTimeout(function() { //give notify a chance to display before redirect
                        window.location.href = "{!! URL::previous() !!}";
                        }, 2000);
                    } else {
                        notify('{{trans('fi.unknown_error')}}', 'error');
                    }
                }).catch(function (response) {
                    var errors = '';
                    for (datas in response.data) {
                        errors += response.data[datas] + '<br>';
                    }
                    notify(errors, 'error');
                });
            };
        });
    </script>
@stop