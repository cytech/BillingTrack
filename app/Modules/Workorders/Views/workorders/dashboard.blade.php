@extends('Workorders::partials._master')

@section('content')
    <script>
        $(function () {
            $('.create-workorder').click(function () {
                clientName = $(this).data('unique-name');
                $('#modal-placeholder').load('{{ route('workorders.create') }}');
            });
        });
    </script>
    <div class="container col-lg-12">
        <br>
        <nav class="navbar bg-primary ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand mb-0" href="#">{{ trans('Workorders::texts.workorders') }}</a>
                </div>
                <ul class="nav navbar-nav ">
                    <li>
                        <a href="javascript:void(0)" class="create-workorder"> {{ trans('Workorders::texts.create_workorder') }}</a></li>
                    <li>
                        <a href="{!! route('workorders.index',['status' => config('workorder_settings.statusFilter')]) !!}" >
                            {{ trans('Workorders::texts.workorder_table') }}</a></li>
                    <li><a href="{!! route('employees.index') !!}">{{ trans('Workorders::texts.employees') }}</a>
                    </li>
                    <li><a href="{!! route('resources.index') !!}">{{ trans('Workorders::texts.resources') }}</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                           href="#">{{ trans('Workorders::texts.timesheet') }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{!! route('timesheets.index') !!}">{{ trans('Workorders::texts.timesheettable') }}</a>
                            </li>
                            <li>
                                <a href="{!! route('timesheets.report') !!}">{{ trans('Workorders::texts.timesheetreport') }}</a>
                            </li>
                            <li>
                                <a href="{!! route('timesheets.about') !!}">{{ trans('Workorders::texts.about') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{ trans('Workorders::texts.utilities') }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @if(config('fi.pdfDriver') == 'wkhtmltopdf')
                                <li><a href="{{ route('workorders.batchprint') }}"><i
                                                class="fa fa-print"></i> {{ trans('Workorders::texts.batchprint') }}
                                    </a>
                                </li>
                            @endif
                            <li><a href="{{ route('workorders.settings') }}"><i
                                            class="fa fa-wrench"></i> {{ trans('Workorders::texts.workorder_settings') }}
                                </a>
                            </li>
                                <li><a href="{{ route('workorders.trash') }}"><i
                                                class="fa fa-trash"></i> {{ trans('Workorders::texts.trash') }}
                                    </a>
                                </li>
                            <li><a href="{{ route('workorders.about') }}"><i
                                            class="fa fa-question-circle"></i> {{ trans('Workorders::texts.about') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>


        {{--Reminder table --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bell-o"></i> {{ trans('Workorders::texts.todays_workorders') }}</h3>
            </div>
            <div class="panel-body">
                <table id="dt-reminderstable" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('Workorders::texts.customer') }}</th>
                        <th>{{ trans('Workorders::texts.start_time') }}</th>
                        <th>{{ trans('Workorders::texts.end_time') }}</th>
                        <th>{{ trans('Workorders::texts.will_call') }}</th>
                        <th>{{ trans('Workorders::texts.workorder_link') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workorders as $workorder)
                        <tr id="{!! $workorder->id !!}">
                            <td>{!! $workorder->client->name !!}</td>
                            <td>{!! $workorder->start_time !!}</td>
                            <td>{!! $workorder->end_time !!}</td>
                            <td>{!! ($workorder->will_call == 1 )?'Yes':'No' !!}</td>
                            <td><a href="{!! url('/workorders') . '/' . $workorder->id . '/edit' !!}">
                                    {{ trans('Workorders::texts.link_to_workorder') }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('Workorders::texts.month_workorders') }}
            </div>
            <div class="panel-body">
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    {!! Html::style('assets/addons/Workorders/Assets/morris.js.so/morris.css') !!}
    {!! Html::script('assets/addons/Workorders/Assets/raphael/raphael.min.js') !!}
    {!! Html::script('assets/addons/Workorders/Assets/morris.js.so/morris.min.js') !!}
    {{--{!! Html::script('assets/addons/Workorders/assets/js/morris-data.js') !!}--}}
    <script type="text/javascript" language="javascript" class="init">
        $(function () {
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [
                        @foreach($fullMonthEvent as $MonthEvent)
                    {
                        y: "{!! date('M-d', strtotime($MonthEvent->job_date)) !!}",
                        a: "{!! $MonthEvent->total !!}"
                    },
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['{{ trans('Workorders::texts.total_workorders_day') }}'],
                hideHover: 'auto',
                resize: true
            });
        });
    </script>
@stop