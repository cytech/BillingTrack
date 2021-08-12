@extends('layouts.master')
@section('content')
    @include('partials._createworkorder')
    @include('layouts._alerts')
    <div class="content-header">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default-default">
                    <div class="card-header h2 d-flex justify-content-center">@lang('bt.employee'){{'/'}}@lang('bt.resource') @lang('bt.schedule')</div>
                    {!! Form::open(['route' => 'scheduler.showschedule','id' => 'showschedule']) !!}
                    <div class="card-body p-1">
                        <div class="card-text d-flex justify-content-center mt-1 mb-3">
                            <input type="hidden" value=" {{ $dates[0] }}" name="sdate">
                            <input class="btn btn-success" type="submit" name="back" value="<< Back">
                            <input class="btn btn-secondary" type="submit" name="today" value="<< Today >>">
                            <input class="btn btn-success" type="submit" name="forward" value="Forward >>">
                        </div>
                        <div class="row">
                            @foreach($dates as $date)
                                <div class="col-sm-3">
                                    <div class="h4 d-flex justify-content-center">{{ Carbon\Carbon::parse($date)->format('l m/d/Y') }}
                                    @if(config('bt.schedulerCreateWorkorder'))
                                        <button type='button' id='createWorkorder{{ $loop->index }}' data-date = '{{ $date }}' class='btn btn-link btn-sm '  title='@lang('bt.create_workorder')'><i class='createwobutton far fa-file-alt' ></i></button>
                                    @endif
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-success btn-block " type="button"
                                                        data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                    @lang('bt.employees_not_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                            <div class="card-body p-0">
                                                <table class="table table-striped table-bordered table-sm"
                                                       id="table1">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($aedata as $emp => $value)
                                                        @if($emp == $date)
                                                            @foreach($value as $emp)
                                                                @if($emp->driver)
                                                                <tr>
                                                                    <td style="color: blue">{{$emp->short_name}}</td>
                                                                </tr>
                                                                @else
                                                                <tr>
                                                                    <td> {!! $emp->short_name !!}</td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-success btn-block collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                    @lang('bt.resources_not_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                            <div class="card-body p-0">
                                                <table class="table table-striped table-bordered table-sm"
                                                       id="table1">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.resource')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ardata as $res => $value)
                                                        @if($res == $date)
                                                            @foreach($value as $res)
                                                                <tr>
                                                                    <td> {!! $res['name'] !!}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-warning btn-block " type="button"
                                                        data-toggle="collapse" data-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                    @lang('bt.employees_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
                                            <div class="card-body p-0">
                                                <table class="table table-striped table-bordered table-sm"
                                                       id="table1">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.client')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledemp as $emp)
                                                        @if($emp->job_date->format('Y-m-d') == $date)
                                                            @foreach($emp->workorderItems->sortBy('name') as $woitem)
                                                                <tr>
                                                                    @foreach ($woitem->employees as $woemp)
                                                                    @if($woemp->driver)
                                                                        <td style="color: blue">{{$woitem->name}}</td>
                                                                    @else
                                                                        <td> {{ $woitem->name }} </td>
                                                                    @endif
                                                                    @endforeach
                                                                    <td> {{ $emp->formatted_start_time }}</td>
                                                                    <td> {{ $emp->formatted_end_time }}</td>
                                                                    <td> {{ $emp->client->name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour">
                                            <h2 class="mb-0">
                                                <button class="btn btn-warning btn-block" type="button"
                                                        data-toggle="collapse" data-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
                                                    @lang('bt.resources_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour">
                                            <div class="card-body p-0">
                                                <table class="table table-striped table-bordered table-sm"
                                                       id="table1">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.resource')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.client')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledprod as $prod)
                                                        @if($prod->job_date->format('Y-m-d') == $date)
                                                            @foreach($prod->workorderItems as $woitem)
                                                                <tr>
                                                                    <td> {{ $woitem->name }}</td>
                                                                    <td> {{ $prod->formatted_start_time }}</td>
                                                                    <td> {{ $prod->formatted_end_time }}</td>
                                                                    <td> {{ $prod->client->name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFive">
                                            <h2 class="mb-0">
                                                {{--                                            remove class collapsed--}}
                                                <button class="btn btn-warning btn-block" type="button"
                                                        data-toggle="collapse" data-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                    @lang('bt.employee_appointments')
                                                </button>
                                            </h2>
                                        </div>
                                        {{--                                    add class show--}}
                                        <div id="collapseFive" class="collapse show" aria-labelledby="headingFive">
                                            <div class="card-body p-0">
                                                <table class="table table-striped table-bordered table-sm"
                                                       id="table1">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.description')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledcalemp as $emp)
                                                        @if(\Carbon\Carbon::parse($emp->start_date)->format('Y-m-d') == $date)
                                                            @foreach($emp->resources as $calemp)
                                                                <tr>
                                                                    <td> {{ $calemp->value }}</td>
                                                                    <td> {{ $emp->formatted_start_date }}</td>
                                                                    <td> {{ $emp->formatted_end_date }}</td>
                                                                    <td> {{ $emp->description }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javaScript')
    {!! Html::script('plugins/moment/moment.min.js') !!}
    {!! Html::script('plugins/jquery-validation/jquery.validate.min.js') !!}

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        $.fn.button.noConflict();
        /*createworkorder dialog*/
        $(".start_time").datetimepicker({
            datepicker: false,
            format: 'H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            defaultTime: '08:00',
            step: {!! config('bt.schedulerTimestep') !!},//15
            onClose: function (selectedTime) {
                $(".end_time").datetimepicker({minTime: selectedTime});
            }
        });

        $('.end_time').datetimepicker({
            datepicker: false,
            format: 'H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            step: {!! config('bt.schedulerTimestep') !!},
            onClose: function (selectedTime) {
                $(".start_time").datetimepicker({maxTime: selectedTime});
            }
        });

        $(document).on('click', '[id^=createWorkorder]', function () {
            let date = $(this).data("date");
            $('#create-workorder').dialog({
                autoOpen: false,
                width: 800,
                position: {my: 'center top', at: 'center top', of: '.card-text', collision: 'none'},
                closeOnEscape: true,
                modal: true,
                buttons: {
                    "@lang('bt.create_workorder')": function () {
                        $('form#create-workorderform').submit();//send to validate
                    },
                    "@lang('bt.cancel')": function () {
                        $(this).dialog("close");
                    },

                },
                title: "@lang('bt.create_workorder') for @lang('bt.job_date') " + moment(date).format('dddd MMMM DD, YYYY'),
                open: function () {
                    $("#job_date").val(moment(date).format('YYYY-MM-DD'));
                    $("#start_time").val('08:00');
                    $("#end_time").val('09:00');
                },
                close: function () {
                    $('#wtable').empty();
                    $('#rtable').empty();
                }
            });
            $.ajax(
                {
                    url: '/scheduler/getResources/' + moment(date).format('YYYY-MM-DD'),
                    type: 'get',
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        $.each(data.available_employees, function (k, v) {
                            const cb = $('<input/>', {
                                'type': 'checkbox',
                                'id': 'worker',
                                'name': 'workers[]',
                                'value': v.id
                            });
                            if (v.driver) {//if driver passed from json
                                $("#wtable").append($('<label/>', {
                                    'style': 'display:block;color:blue',
                                    'text': v.short_name
                                }).prepend("  ").prepend(cb))
                            } else {
                                $("#wtable").append($('<label/>', {
                                    'style': 'display:block',
                                    'text': v.short_name
                                }).prepend("  ").prepend(cb))
                            }
                        });
                        $.each(data.available_resources, function (k, v) {
                            const cb = $('<input/>', {
                                'type': 'checkbox',
                                'id': 'resource',
                                'name': 'resources[]',
                                'value': v.id
                            });
                            const qty = $('<input/>', {
                                'type': 'number',
                                'id': 'quantity' + v.id + '',
                                'name': 'quantity[' + v.id + ']',
                                'min': '0',
                                'style': 'width:40px;height:25px',
                                'disabled': true,
                                'value': 1
                            });
                            $("#rtable").append($('<label/>', {
                                'style': 'display:block',
                                'text': v.name
                            }).prepend("  ").prepend(cb).append("&nbsp;&nbsp;&nbsp;").append(qty))
                        });

                    }
                });


            $("#client_name").autocomplete({
                appendTo: "#create-workorder",
                source: "/scheduler/ajax/customer",
                minLength: 3
            }).autocomplete("widget");

            $.validator.addMethod("endtime_greater_starttime", function (value, element) {
                return $('#end_time').val() > $('#start_time').val()
            }, "End Time must be greater than Start Time");

            $('#create-workorderform').validate({
                rules: {
                    end_time: {
                        required: true,
                        endtime_greater_starttime: true,
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $('#create-workorder').dialog('open');
        })
    })

</script>
@endsection
