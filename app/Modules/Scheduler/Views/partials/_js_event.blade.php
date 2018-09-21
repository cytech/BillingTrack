@section('javascript')
    {{--{!! Html::style('assets/addons/Scheduler/Assets/css/jquery-ui-peppergrinder.min.css') !!}--}}
    {{--{!! Html::style('css/jquery-ui-cupertino.min.css') !!}--}}
    <style>
       /* .xdsoft_datetimepicker {
            z-index: 99999;
        }

        .xdsoft_datetimepicker .xdsoft_label {
            z-index: 99999;
        }

        .reminder_date {
            position: relative;
            z-index: 10000;
        }*/

        /* .ui-dialog .ui-dialog-content {
             border: 0;
             padding: 20px;
             font-size:18px;
             color: #000000;
             background-color: #ebebeb;
             overflow: auto;
         }*/

        .ui-widget {
            position: relative;
            z-index: 900;
        }

        /*.swal2-container {*/
            /*z-index: 900;*/
        /*}*/


    </style>
    {!! Html::style('assets/plugins/fullcalendar/fullcalendar.min.css') !!}
    {{-- bug introduced in laravel collective 5.5 https://github.com/LaravelCollective/html/issues/504 }}
    {{--{!! Html::style('assets/addons/Scheduler/Assets/fullcalendar/dist/fullcalendar.print.min.css',['media'=>'print']) !!}--}}
    <link href="/assets/plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" type="text/css" media="print" />
    {!! Html::script('assets/plugins/moment/moment.min.js') !!}
    {!! Html::script('assets/plugins/fullcalendar/fullcalendar.min.js') !!}
    {{-- customized to allow month view sort by category/start--}}
    {{--{!! Html::script('js/fullcalendar.mod.min.js') !!}--}}
    {!! Html::script('assets/plugins/jquery-validation/jquery.validate.min.js') !!}

    <script>
        $(document).ready(function () {
            $(".readonly").keydown(function (e) {
                e.preventDefault();
            });
            $("#addReminderCreate").click(function (event) {
                event.preventDefault();
                $("#addReminderCreate").html('<i class="fa fa-plus"></i>{{ trans('fi.add_another_reminder') }}');
                $("#addReminderShow").append($(".addReminderView").html());
            });
            $("#updateReminderCreate").click(function (event) {
                event.preventDefault();
                $("#updateReminderCreate").html('<i class="fa fa-plus"></i>{{ trans('fi.add_another_reminder') }}');
                $("#updateReminderShow").append($(".addReminderView").html());
            });

            @include('partials._js_saveCalendarEvent_js')
            @include('partials._js_updateCalendarEvent_js')

            /* init first - init first */
            $('#calEventDialog').dialog({autoOpen: false});
            $('#editEvent').dialog({autoOpen: false});
            $('#create-workorder').dialog({autoOpen: false});
            /*fullcalendar event dialog datetimepicker (create,update,reminders)*/
            $(".from").datetimepicker({
                format: 'Y-m-d H:i',
                defaultTime: '08:00',
                step: {!! config('fi.schedulerTimestep') !!},//15
                onClose: function (selectedDate) {
                    $(".to").datetimepicker({minDate: selectedDate});
                }
            });
            $('.to').datetimepicker({
                format: 'Y-m-d H:i',
                step: {!! config('fi.schedulerTimestep') !!},
                onClose: function (selectedDate) {
                    $(".from").datetimepicker({maxDate: selectedDate});
                }
            });
            /*createworkorder dialog*/
            $(".start_time").datetimepicker({
                datepicker: false,
                format: 'H:i',
                defaultTime: '08:00',
                step: {!! config('fi.schedulerTimestep') !!},//15
                onClose: function (selectedTime) {
                    $(".end_time").datetimepicker({minTime: selectedTime});
                }
            });

            $('.end_time').datetimepicker({
                datepicker: false,
                format: 'H:i',
                step: {!! config('fi.schedulerTimestep') !!},
                onClose: function (selectedTime) {
                    $(".start_time").datetimepicker({maxTime: selectedTime});
                }
            });

            $(document).on('mousedown', '.reminder_date', function () {
                $(this).datetimepicker({
                    format: 'Y-m-d H:i',
                    defaultDate: '+1970/01/08', //plus 1 week
                    step: {!! config('fi.schedulerTimestep') !!}
                });
            });

            $(document).on('click', '.delete_reminder', function () {
                $(this).parent().parent().remove();
            });

            $('#calendar').fullCalendar({
                themeSystem: '{!! config('fi.schedulerFcThemeSystem') !!}', //'jquery-ui' 'bootstrap3' 'standard'
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth,listWeek,listDay'
                },
                buttonText: {
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    listMonth: 'Month List',
                    listWeek: 'Week List',
                    listDay: 'Day List'
                },
                aspectRatio: {!! config('fi.schedulerFcAspectRatio') !!},//1.35 default
                //displayEventTime: false,  //show starttime in event title
                // customized fullcalendar.mod.js to allow month view sort by category/start
                //eventOrder sorts events with same dates/times
                eventOrder: "category,start",
                // add createworkorder button to day cell header
                @if(config('fi.schedulerCreateWorkorder'))
                viewRender: function (view, element) {
                    // Add the "button" to the day headers
                    var $headers = $('.fc-day-top');
                    $headers.css('position', 'relative');
                    $headers.prepend("<div id='cwo'><button type='button' id='createWorkorder' class='btn btn-link btn-sm ' style='position: absolute; left: 0' title='{{ trans('fi.create_workorder') }}'><i class='createwobutton fa fa-file-text-o' ></i></button> </div>");
                },
                @endif
                defaultDate: "{!! date('Y-m-d') !!}",
                @if($status == 'last')
                defaultDate: "{!! date('Y-m-d', strtotime("first day of previous month")) !!}",
                @elseif($status == 'next')
                defaultDate: "{!! date('Y-m-d', strtotime("first day of next month")) !!}",
                @else
                defaultDate: "{!! date('Y-m-d') !!}",
                @endif
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    $("#title").autocomplete({
                        appendTo: "#calEventDialog",
                        source: "/scheduler/ajax/employee",
                        minLength: 2
                    }).autocomplete("widget").addClass("fixed-height");
                    $("#title").val('');
                    $("#description").val('');
                    $(".from").val(start.format('YYYY-MM-DD 08:00'));
                    $(".to").val(start.endOf('day').format('YYYY-MM-DD 09:00'));
                    $("#category").val(2); //default to general appointment
                    $("#addReminderShow").html('');
                    $('#calEventDialog').dialog({
                        width: 500,
                        position: {my: 'center top', at: 'center+100 top+200', of: window}
                    });
                },
                dayClick: function (date, jsEvent, view) {
                    // IF BUTTON ICON SELECTED
                    if ($(jsEvent.target).hasClass("createwobutton")) {
                        $.ajax(
                            {
                                url: '/scheduler/getResources/' + date.format('YYYY-MM-DD'),
                                type: 'get',
                                dataType: 'json',
                                cache: false,
                                success: function (data) {
                                    $.each(data.available_employees, function (k, v) {
                                        var cb = $('<input/>', {
                                            'type': 'checkbox',
                                            'id': 'worker',
                                            'name': 'workers[]',
                                            'value': k
                                        });
                                        if (v.indexOf("___D") >= 0) {//if driver ___D passed from json
                                            v = v.replace("___D", "");
                                            $("#wtable").append($('<label/>', {
                                                'style': 'display:block;color:blue',
                                                'text': v
                                            }).prepend("  ").prepend(cb))
                                        } else {
                                            $("#wtable").append($('<label/>', {
                                                'style': 'display:block',
                                                'text': v
                                            }).prepend("  ").prepend(cb))
                                        }
                                    });
                                    $.each(data.available_resources, function (k, v) {
                                        var cb = $('<input/>', {
                                            'type': 'checkbox',
                                            'id': 'resource',
                                            'name': 'resources[]',
                                            'value': v.id
                                        });
                                        var qty = $('<input/>', {
                                            'type': 'number',
                                            'id': 'quantity'+v.id+'',
                                            'name': 'quantity['+v.id+']',
                                            'min': '0',
                                            'style': 'width:40px;',
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
                        }).autocomplete("widget").addClass("fixed-height");

                        $('#create-workorderform').validate({
                            submitHandler: function (form) {
                                form.submit();
                            }
                        });

                        $('#create-workorder').dialog({
                            width: 650,
                            position: {my: 'center top', at: 'center top', of: '.fc-view-container'},
                            closeOnEscape: true,
                            buttons: {
                                "{{trans('fi.create_workorder')}}": function () {
                                    $('form#create-workorderform').submit();//send to validate
                                },
                                "{{trans('fi.cancel')}}": function () {
                                    $(this).dialog("close");
                                }
                            },
                            open: function () {
                                $("#job_date").val(date.format('YYYY-MM-DD'));
                                $("#start_time").val('08:00');
                                $("#end_time").val('09:00');
                            },
                            close: function () {
                                $('#wtable').empty();
                                $('#rtable').empty();
                            }
                        });

                        $('#create-workorder').dialog('open');

                    } else {
                        $('#calEventDialog').dialog('open');
                    }
                },
                eventClick: function (event, element) {
                    // added link to workorder
                    if (event.url) {
                        window.open(event.url, '_parent');
                        return false;
                    }
                    if (event.isrecurring === '1') {
                        swal({
                            title: '{{ trans('fi.recurring_event_warning') }}',
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: '#d68500',
                            confirmButtonText: '{{ trans('fi.confirm_recurr_warning') }}'
                        });
                    }

                    $("#reminderShowFormCalendar").html('');
                    $("#updateReminderShow").html('');

                    if (event.reminder) {
                        var reminderHtml = '';
                        for (var key in event.reminder) {

                            reminderHtml += '<div class="reminder_delete_div"><div class="form-group">' +
                                '<hr class="col-sm-10 hr-clr-green"/>' +
                                '<span class="col-sm-1 pull-right reminder-cross delete_reminder" style="cursor: pointer"><i class="fa fa-times-circle"></i></span>' +
                                '</div><div class="form-group">' +
                                '<label for="reminder_date" class="col-sm-3 control-label">{{ trans('fi.reminder_date') }}</label>' +
                                '<div class="col-sm-9">' +
                                '<input type="text" name="reminder_date[]" class="form-control reminder_date " style="cursor: pointer" readonly value="' + event.reminder[key].reminder_date + '">' +
                                '<input type="hidden" name="reminder_id[]"  value="' + event.reminder[key].reminder_id + '">' +
                                '</div></div><div class="form-group">' +
                                '<label for="reminder_location" class="col-sm-3 control-label">{{ trans('fi.reminder_location') }}</label>' +
                                '<div class="col-sm-9">' +
                                '<input type="text" name="reminder_location[]" class="form-control" value="' + event.reminder[key].reminder_location + '">' +
                                '</div></div><div class="form-group">' +
                                '<label for="reminder_text" class="col-sm-3 control-label">{{ trans('fi.reminder_text') }}</label>' +
                                '<div class="col-sm-9">' +
                                '<textarea name="reminder_text[]" class="form-control" >' + event.reminder[key].reminder_text + '</textarea>' +
                                '</div></div></div>'
                        }
                        $("#reminderShowFormCalendar").html(reminderHtml);
                    }
                    $("#editTitle").autocomplete({
                        appendTo: "#editEvent",
                        source: "/scheduler/ajax/employee",
                        minLength: 2
                    }).autocomplete("widget").addClass("fixed-height");
                    $("#editTitle").val(event.title);
                    $("#editDescription").val(event.description);
                    $("#editID").val(event.id);
                    $("#editOID").val(event.oid);
                    $("#editStart").val(event.start._i);
                    $("#editEnd").val(event.end._i);
                    $("#editCategory").val(event.category);//defined inside calendar.blade
                    $('#editEvent').dialog({
                        width: 500,
                        position: {my: 'center top', at: 'center+100 top+200', of: window}
                    });
                    $('#editEvent').dialog('open');

                },
                // added mouseover
                eventMouseover: function (event, jsEvent, view) {
                    var rstr = "";
                    var tooltip = "";
                    if (event.type === 'Workorder') {
                        var wrstr = "{{trans('fi.employees')}}: ";
                        if (event.willcall === '1') {
                            wrstr = "<span style='color:magenta'>{{trans('fi.employees')}}: </span>";
                        }
                        var erstr = "Resources: ";
                        if (event.hasOwnProperty("resource")) {
                            $.each(event.resource, function (key, value) {

                                if (value.resource_table === 'employees' && value.resource_value) { //employees and not empty
                                    wrstr += " " + value.resource_value;
                                }
                                if (value.resource_table === 'products') { // Resources
                                    erstr += " " + value.resource_value;
                                }
                            });
                        }
                        if ((wrstr === "{{trans('fi.employees')}}: ") || (wrstr === "<span style='color:magenta'>{{trans('fi.employees')}}: </span>")) {
                            wrstr = "";
                        }
                        if (erstr === "Resources: ") {
                            erstr = "";
                        }
                        rstr = wrstr + "<br>" + erstr;
                    }
                    if (event.type === 'Workorder' || event.type === undefined) {
                        tooltip = '<div class="tooltipevent" style="width:200px;background:#eee;position:absolute;z-index:10001;">'
                            + event.start.format("MMM DD H:mm") + ' to ' + event.end.format("H:mm") + '<br>'
                            + event.description
                            + '<br>'
                            + rstr
                            + '</div>';
                    }
                    $("body").append(tooltip);
                    $(this).mouseover(function (e) {
                        $(this).css('z-index', 10000);
                        $('.tooltipevent').fadeIn('500');
                        $('.tooltipevent').fadeTo('10', 1.9);
                    }).mousemove(function (e) {
                        $('.tooltipevent').css('top', e.pageY - $('.tooltipevent').height() / 2);//was + 10
                        $('.tooltipevent').css('left', e.pageX + 15);
                    });
                },

                eventMouseout: function (event, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.tooltipevent').remove();
                },

                //editable: true,

                eventLimit: parseInt({!! config('fi.schedulerEventLimit') !!}), // true allows "more" link when too many events

                events: [
                        @foreach($events as $event)
                    {
                        //schedule
                        id: "{!! $event->id !!}",
                        title: "{!! $event->title !!}",
                        description: "{!! addslashes($event->description) !!}",
                        isrecurring: "{!! $event->isRecurring !!}",
                        category: "{!! $event->category_id !!}",
                        @isset($event->category_id)
                        color: "{!! $catbglist[$event->category_id] !!}",
                        textColor: "{!! $cattxlist[$event->category_id] !!}",
                        @endisset
                        url: "{!! $event->url !!}",
                        willcall: "{!! $event->will_call !!}",
                        //occurrences
                        oid: "{!! $event->oid !!}",
                        start: "{!! date('Y-m-d H:i', strtotime($event->start_date )) !!}",
                        end: "{!! date('Y-m-d H:i', strtotime($event->end_date )) !!}",
                        //resources
                        @if(!$event->resources->isEmpty())
                        resource: [
                                @foreach($event->resources as $resource)
                            {
                                resource_table: "{!! $resource->resource_table !!}",
                                resource_value: "{!! $resource->value !!}"
                            },
                            @endforeach

                        ],
                        @endif
                        //reminders
                        @if(!$event->reminders->isEmpty())
                        reminder: [
                                @foreach($event->reminders as $reminder)
                            {
                                reminder_date: "{!! date('Y-m-d H:i', strtotime($reminder->reminder_date)) !!}",
                                reminder_location: "{!! $reminder->reminder_location !!}",
                                reminder_text: "{!! $reminder->reminder_text !!}",
                                reminder_id: "{!! $reminder->id !!}"
                            },
                            @endforeach
                        ]
                        @endif
                    },
                    @endforeach
                    // coreevents
                        @if($coreevents)

                        @foreach($coreevents as $coreevent){
                        id: "{!! $coreevent->id !!}",
                        type: "{!! strtok($coreevent->id, ':') !!}",
                        url: "{!! $coreevent->url !!}",
                        title: "{!! $coreevent->title !!}",
                        @isset($coreevent->description)
                        description: "{!! $coreevent->description !!}",
                        @endisset
                        @isset($coreevent->will_call)
                        willcall: "{!! $coreevent->will_call !!}",
                        @endisset
                        @isset($coreevent->category_id)
                        color: "{!! $catbglist[$coreevent->category_id] !!}",
                        textColor: "{!! $cattxlist[$coreevent->category_id] !!}",
                        @endisset
                        start: "{!! $coreevent->start !!}",
                        @isset($coreevent->end)
                        end: "{!! $coreevent->end !!}",
                        @endisset
                        @isset($coreevent->resources)
                        resource: [
                        @foreach($coreevent->resources as $resource)
                            {
                                resource_table: "{!! $resource->resource_table !!}",
                                resource_value: "{!! addslashes($resource->name) !!}"
                            },
                        @endforeach
                        ],
                        @endisset
                    },
                    @endforeach
                    @endif


                ],
            });
            @if(Session::has('success'))
            notify('{!! Session::get('success') !!}', 'success');
            @endif
        });
    </script>
    <style>
        #calendar {
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;
            margin: 0 auto 0 0;
        }
    </style>
@stop