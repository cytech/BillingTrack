@extends('layouts.master')

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
        <nav class="navbar navbar-light ">
            <div class="container-fluid">

                    <a class="navbar-brand mb-0" href="#">{{ trans('fi.workorders') }}</a>

                <ul class="nav navbar-nav ">
                    <li>
                        <a href="javascript:void(0)" class="create-workorder"> {{ trans('fi.create_workorder') }}</a></li>
                    <li>
                        <a href="{!! route('workorders.index',['status' => config('fi.workorderStatusFilter')]) !!}" >
                            {{ trans('fi.workorder_table') }}</a></li>
                    <li><a href="{!! route('employees.index') !!}">{{ trans('fi.employees') }}</a>
                    </li>
                    <li><a href="{!! route('products.index') !!}">{{ trans('fi.products') }}</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                           href="#">{{ trans('fi.timesheet') }}
                            </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{!! route('timesheets.report') !!}">{{ trans('fi.timesheetreport') }}</a>
                            </li>
                            <li>
                                <a href="{!! route('timesheets.about') !!}">{{ trans('fi.about') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{ trans('fi.utilities') }}
                            </a>
                        <ul class="dropdown-menu">
                                <li><a href="{{ route('utilities.batchprint') }}"><i
                                                class="fa fa-print"></i> {{ trans('fi.batchprint') }}
                                    </a>
                                </li>
                            <li><a href="{{ route('workorders.about') }}"><i
                                            class="fa fa-question-circle"></i> {{ trans('fi.about') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>


        {{--Reminder table --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-bell"></i> {{ trans('fi.todays_workorders') }}</h3>
            </div>
            <div class="card-body">
                <table id="dt-reminderstable" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('fi.customer') }}</th>
                        <th>{{ trans('fi.start_time') }}</th>
                        <th>{{ trans('fi.end_time') }}</th>
                        <th>{{ trans('fi.will_call') }}</th>
                        <th>{{ trans('fi.workorder_link') }}</th>
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
                                    {{ trans('fi.link_to_workorder') }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-chart-bar fa-fw"></i> {{ trans('fi.month_workorders') }}
            </div>
            <div class="card-body">
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    {!! Html::style('plugins/morris.js.so/morris.css') !!}
    {!! Html::script('plugins/raphael/raphael.min.js') !!}
    {!! Html::script('plugins/morris.js.so/morris.min.js') !!}
    {{--{!! Html::script('plugins/js/morris-data.js') !!}--}}
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
                labels: ['{{ trans('fi.total_workorders_day') }}'],
                hideHover: 'auto',
                resize: true
            });
        });
    </script>
@stop