@extends('layouts.master')

@section('content')
    @include('layouts._alerts')
    <section class="content-header">
        <nav class="navbar navbar-expand navbar-light border-bottom">   {{--bg-primary navbar-default--}}
            <div class="container-fluid">

                    <a class="navbar-brand mb-0" href="#">@lang('bt.schedule_dashboard')</a>

                <div class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.fullcalendar') !!}">@lang('bt.calendar')</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.create') !!}">@lang('bt.create_event')</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.tableevent') !!}">@lang('bt.event_table')</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="{!! route('scheduler.tablerecurringevent') !!}">@lang('bt.recurring_event')</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">@lang('bt.utilities')
                            </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                               href="{!! route('scheduler.categories.index') !!}"><i
                                        class="nav-icon fas fa-thumbtack"></i> @lang('bt.categories')</a>
                            <a class="dropdown-item"
                               href="{!! route('scheduler.checkschedule') !!}"><i
                                        class="nav-icon fas fa-check-double"></i> @lang('bt.orphan_check')</a>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
        <div class="row col-lg-12 pl-5">
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $monthEvent !!}</h1></div>
                        <p>@lang('bt.events_this_month')</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}">
                        @lang('bt.vevents_this_month')
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $lastMonthEvent !!}</h1></div>
                        <p>@lang('bt.events_last_month')</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=last">
                        @lang('bt.vevents_last_month')
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <div><h1 class="text-bold">{!! $nextMonthEvent !!}</h1></div>
                        <p>@lang('bt.events_next_month')</p>
                    </div>
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=next">
                        @lang('bt.vevents_next_month')
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row col-lg-12 pl-5">
            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <div>{!! $thisquotes !!} @lang('bt.this_approved_quotes')</div>
                        <div>{!! $thisworkorders !!} @lang('bt.this_approved_workorders')</div>
                        <div>{!! $thisinvoices !!} @lang('bt.this_sent_invoices')</div>
                        <div>{!! $thispayments !!} @lang('bt.this_received_payments')</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <div>{!! $lastquotes !!} @lang('bt.last_approved_quotes')</div>
                        <div>{!! $lastworkorders !!} @lang('bt.last_approved_workorders')</div>
                        <div>{!! $lastinvoices !!} @lang('bt.last_sent_invoices')</div>
                        <div>{!! $lastpayments !!} @lang('bt.last_received_payments')</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <div>{!! $nextquotes !!} @lang('bt.next_approved_quotes')</div>
                        <div>{!! $nextworkorders !!} @lang('bt.next_approved_workorders')</div>
                        <div>{!! $nextinvoices !!} @lang('bt.next_sent_invoices')</div>
                        <div>{!! $nextpayments !!} @lang('bt.next_received_payments')</div>
                    </div>
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                </div>
            </div>
        </div>
            {{--Reminder table --}}
            <div class="container-fluid">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-bell"></i> @lang('bt.reminders')</h3>
                    </div>
                    <div class="card-body">
                        <table id="dt-reminderstable" class="display table dataTable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>@lang('bt.event_title')</th>
                                <th>@lang('bt.reminder_text')</th>
                                <th>@lang('bt.occasion_start')</th>
                                <th>@lang('bt.occasion_end')</th>
                                <th>@lang('bt.link')</th>
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
                                                @lang('bt.link_to_workorder')</a></td>
                                    @else
                                        <a href="#" class="btn btn-danger btn-sm" id="delete-reminder-{{ $reminder->id }}"
                                           onclick="swalConfirm('@lang('bt.reminder_trash_warning')', '', '{{ route('scheduler.trashreminder', $reminder->id) }}');"><i
                                                    class="fa fa-trash-alt"></i> @lang('bt.trash')
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
                                    class="fa fa-chart-bar fa-bar fa-fw"></i> @lang('bt.month_day_events')</h3>
                    </div>
                    <div class="card-body">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-chart-bar fa-fw"></i> @lang('bt.year_month_report')
                    </h3>
                </div>
                <div class="card-body">
                    <div id="morris-donut-chart" style="width: 100%;height: 400px;font-size: 11px;"></div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javaScript')
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


