@extends('layouts.master')

@section('content')
    <div class="container col-lg-12">
        <br>
        <nav class="navbar navbar-default ">   {{--bg-primary navbar-default--}}
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand mb-0" href="#">{{ trans('fi.schedule_dashboard') }}</a>
                </div>
                <ul class="nav navbar-nav ">
                    <li><a href="{!! route('scheduler.fullcalendar') !!}">{{ trans('fi.calendar') }}</a></li>
                    <li><a href="{!! route('scheduler.create') !!}">{{ trans('fi.create_event') }}</a></li>
                    <li><a href="{!! route('scheduler.tableevent') !!}">{{ trans('fi.event_table') }}</a></li>
                    <li><a href="{!! route('scheduler.tablerecurringevent') !!}">{{ trans('fi.recurring_event') }}</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('fi.utilities') }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! route('scheduler.tablereport') !!}">{{ trans('fi.table_report') }}</a></li>
                            <li><a href="{!! route('scheduler.calendarreport') !!}">{{ trans('fi.calendar_report') }}</a></li>
                            <li><a href="{!! route('scheduler.categories.index') !!}">{{ trans('fi.categories') }}</a></li>
                            <li><a href="{!! route('scheduler.about') !!}">{{ trans('fi.about') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row col-lg-12">
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{!! $monthEvent !!}</div>
                                <div>{{ trans('fi.events_this_month') }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{!! route('scheduler.fullcalendar') !!}">
                        <div class="panel-footer">
                            <span class="pull-left">{{ trans('fi.vevents_this_month') }}</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{!! $lastMonthEvent !!}</div>
                                <div>{{ trans('fi.events_last_month') }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{!! route('scheduler.fullcalendar') !!}?status=last">
                        <div class="panel-footer">
                            <span class="pull-left">{{ trans('fi.vevents_last_month') }}</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{!! $nextMonthEvent !!}</div>
                                <div>{{ trans('fi.events_next_month') }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{!! route('scheduler.fullcalendar') !!}?status=next">
                        <div class="panel-footer">
                            <span class="pull-left">{{ trans('fi.vevents_next_month') }}</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        {{--Reminder table --}}
        <div class="row col-lg-12" ng-app="event" ng-controller="eventDeleteController">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bell-o"></i> {{ trans('fi.reminders') }}</h3>
                </div>
                <div class="panel-body">
                    <table id="dt-reminderstable" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>{{ trans('fi.event_title') }}</th>
                            <th>{{ trans('fi.reminder_text') }}</th>
                            <th>{{ trans('fi.occasion_start') }}</th>
                            <th>{{ trans('fi.occasion_end') }}</th>
                            <th>{{ trans('fi.link') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reminders as $reminder)
                            <tr id="{!! $reminder->id !!}">
                                <td>{!! $reminder->Schedule->title !!}</td>
                                <td>{!! $reminder->reminder_text !!}</td>
                                <td>{!! $reminder->Schedule->occurrences->first()->start_date !!}</td>
                                <td>{!! $reminder->Schedule->occurrences->first()->end_date !!}</td>
                                <td><a href="{!! $reminder->Schedule->url !!}">
                                        @if($reminder->Schedule->url)
                                            {{ trans('fi.link_to_workorder') }}</a></td>
                                @else
                                    <a class="btn btn-danger delete" ng-click="delete({!! $reminder->id !!})"><i
                                                class="fa fa-fw fa-trash-o"></i>{{ trans('fi.delete') }}</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('fi.month_day_events') }}</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('fi.year_month_report') }}</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart" style="width: 100%;height: 400px;font-size: 11px;"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    {!! Html::style('assets/plugins/morris.js.so/morris.css') !!}
    {!! Html::script('assets/plugins/raphael/raphael.min.js') !!}
    {!! Html::script('assets/plugins/morris.js.so/morris.min.js') !!}
    {{--{!! Html::script('assets/addons/Scheduler/assets/js/morris-data.js') !!}--}}
    <script type="text/javascript" language="javascript" class="init">
        $(function () {
            Morris.Donut({
                element: 'morris-donut-chart',
                data: [
                        @foreach($fullYearMonthEvent as $yearMonthEvent)
                    {
                        label: "{!! date('M-Y', strtotime($yearMonthEvent->start_date)) !!}",
                        value: "{!! $yearMonthEvent->total !!}"
                    },
                    @endforeach
                ]
            });
        });
        $(function () {
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [
                        @foreach($fullMonthEvent as $MonthEvent)
                    {
                        y: "{!! date('M-d', strtotime($MonthEvent->start_date)) !!}",
                        a: "{!! $MonthEvent->total !!}"
                    },
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Total Event This Day'],
                hideHover: 'auto',
                resize: true
            });
        });
    </script>
    @include('partials._js_eventDeleteController',
            ['droute'=>'scheduler.trashreminder',
            'pnote'=>trans('fi.reminder_deleted_success'),
            'pCnote'=>trans('fi.reminder_delete_warning')])
@stop


