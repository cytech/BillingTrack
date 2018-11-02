@extends('layouts.master')

@section('content')
    @include('layouts._alerts')
    <div class="container col-lg-12">
        <br>
        <nav class="navbar navbar-expand navbar-light border-bottom">   {{--bg-primary navbar-default--}}
            <div class="container-fluid">

                    <a class="navbar-brand mb-0" href="#">{{ trans('fi.schedule_dashboard') }}</a>

                <div class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.fullcalendar') !!}">{{ trans('fi.calendar') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.create') !!}">{{ trans('fi.create_event') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.tableevent') !!}">{{ trans('fi.event_table') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.tablerecurringevent') !!}">{{ trans('fi.recurring_event') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('fi.utilities') }}
                            </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                               href="{!! route('scheduler.categories.index') !!}"><i
                                        class="nav-icon fas fa-thumbtack"></i> {{ trans('fi.categories') }}</a>
                            <a class="dropdown-item"
                               href="{!! route('scheduler.checkschedule') !!}"><i
                                        class="nav-icon fas fa-check-double"></i> {{ trans('fi.orphan_check') }}</a>
                            <a class="dropdown-item" href="{!! route('scheduler.about') !!}"><i
                                        class="nav-icon fa fa-question-circle"></i> {{ trans('fi.about') }}</a>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
        <div class="row col-lg-12">
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $monthEvent !!}</h1></div>
                        <p>{{ trans('fi.events_this_month') }}</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}">
                        {{ trans('fi.vevents_this_month') }}
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $lastMonthEvent !!}</h1></div>
                        <p>{{ trans('fi.events_last_month') }}</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=last">
                        {{ trans('fi.vevents_last_month') }}
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $nextMonthEvent !!}</h1></div>
                        <p>{{ trans('fi.events_next_month') }}</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=next">
                        {{ trans('fi.vevents_next_month') }}
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row col-lg-12">
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <div>{!! $thisquotes !!} {{trans('fi.this_approved_quotes')}}</div>
                        <div>{!! $thisworkorders !!} {{trans('fi.this_approved_workorders')}}</div>
                        <div>{!! $thisinvoices !!} {{trans('fi.this_sent_invoices')}}</div>
                        <div>{!! $thispayments !!} {{trans('fi.this_received_payments')}}</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <div>{!! $lastquotes !!} {{trans('fi.last_approved_quotes')}}</div>
                        <div>{!! $lastworkorders !!} {{trans('fi.last_approved_workorders')}}</div>
                        <div>{!! $lastinvoices !!} {{trans('fi.last_sent_invoices')}}</div>
                        <div>{!! $lastpayments !!} {{trans('fi.last_received_payments')}}</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <div>{!! $nextquotes !!} {{trans('fi.next_approved_quotes')}}</div>
                        <div>{!! $nextworkorders !!} {{trans('fi.next_approved_workorders')}}</div>
                        <div>{!! $nextinvoices !!} {{trans('fi.next_sent_invoices')}}</div>
                        <div>{!! $nextpayments !!} {{trans('fi.next_received_payments')}}</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>

            {{--Reminder table --}}
            {{--<div class="row col-lg-12" ng-app="event" ng-controller="eventDeleteController">--}}
            <div class="container-fluid">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-bell"></i> {{ trans('fi.reminders') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="dt-reminderstable" class="display table dataTable" cellspacing="0" width="100%">
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
                                <tr>
                                    <td>{!! $reminder->Schedule->title !!}</td>
                                    <td>{!! $reminder->reminder_text !!}</td>
                                    <td>{!! $reminder->Schedule->occurrences->first()->start_date !!}</td>
                                    <td>{!! $reminder->Schedule->occurrences->first()->end_date !!}</td>
                                    <td><a href="{!! $reminder->Schedule->url !!}">
                                            @if($reminder->Schedule->url)
                                                {{ trans('fi.link_to_workorder') }}</a></td>
                                    @else
                                        <a href="#" id="delete-reminder-{{ $reminder->id }}"
                                           onclick="swalConfirm('{{ trans('fi.reminder_trash_warning') }}', '{{ route('scheduler.trashreminder', $reminder->id) }}');"><i
                                                    class="btn-danger fa fa-trash-alt"></i> {{ trans('fi.trash') }}
                                        </a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title"><i
                                    class="fa fa-chart-bar fa-bar fa-fw"></i> {{ trans('fi.month_day_events') }}</h3>
                    </div>
                    <div class="card-body">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-chart-bar fa-fw"></i> {{ trans('fi.year_month_report') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div id="morris-donut-chart" style="width: 100%;height: 400px;font-size: 11px;"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    {{--@include('partials._js_datatables')--}}
    {!! Html::style('plugins/morris.js.so/morris.css') !!}
    {!! Html::script('plugins/raphael/raphael.min.js') !!}
    {!! Html::script('plugins/morris.js.so/morris.min.js') !!}
    {{--{!! Html::script('assets/addons/Scheduler/assets/js/morris-data.js') !!}--}}
    <script type="text/javascript" language="javascript" class="init">

        $(function () {
            {{--For dashboard DT --}}
            $('#dt-reminderstable').DataTable({
                order: [[2, "asc"]],//order on start_time
                "columnDefs": [
                    {"orderable": false, "targets": 4}
                ]
            });

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

@stop


