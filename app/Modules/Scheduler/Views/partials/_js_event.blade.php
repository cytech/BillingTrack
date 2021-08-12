@section('javaScript')

    {!! Html::style('plugins/fullcalendar/main.min.css') !!}
    {!! Html::script('plugins/moment/moment.min.js') !!}
    {!! Html::script('plugins/fullcalendar/main.min.js') !!}
    {!! Html::script('plugins/jquery-validation/jquery.validate.min.js') !!}
    <style>
        .xdsoft_datetimepicker .xdsoft_timepicker {
            width: 75px;
            float: left;
            text-align: center;
            margin-left: 8px;
            margin-top: 0;
        }
        {{--fc default is rgba(255,220,40,.15) or #fff9de  --}}
        {{-- temp set #b3ecff --}}
        .fc-day-today {
            background: {{config('bt.schedulerFcTodaybgColor')}} !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(".readonly").keydown(function (e) {
                e.preventDefault();
            });
            $("#addReminderCreate").click(function (event) {
                event.preventDefault();
                $("#addReminderCreate").html('<i class="fa fa-plus"></i>@lang('bt.add_another_reminder')');
                $("#addReminderShow").append($(".addReminderView").html());
            });
            $("#updateReminderCreate").click(function (event) {
                event.preventDefault();
                $("#updateReminderCreate").html('<i class="fa fa-plus"></i>@lang('bt.add_another_reminder')');
                $("#updateReminderShow").append($(".addReminderView").html());
            });

            /* init first - init first */
            $.fn.button.noConflict();
            /*fullcalendar event dialog datetimepicker (create,update,reminders)*/
            $(".from").datetimepicker({
                format: 'Y-m-d H:i',
                formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
                defaultTime: '08:00',
                step: {!! config('bt.schedulerTimestep') !!},//15
                onClose: function (selectedDate) {
                    $(".to").datetimepicker({minDate: selectedDate});
                }
            });
            $('.to').datetimepicker({
                format: 'Y-m-d H:i',
                formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
                step: {!! config('bt.schedulerTimestep') !!},
                onClose: function (selectedDate) {
                    $(".from").datetimepicker({maxDate: selectedDate});
                }
            });
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

            $(document).on('mousedown', '.reminder_date', function () {
                $(this).datetimepicker({
                    format: 'Y-m-d H:i',
                    formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
                    defaultDate: '+1970/01/08', //plus 1 week
                    step: {!! config('bt.schedulerTimestep') !!}
                });
            });

            $(document).on('click', '.delete_reminder', function () {
                $(this).parent().parent().remove();
            });

            var calendarEl = document.getElementById('calendar');

            @include('partials._js_saveCalendarEvent_js')

            var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    themeSystem: '{!! config('bt.schedulerFcThemeSystem') !!}', //'bootstrap' 'standard'
                    headerToolbar: {
                        start: 'prev,next today',
                        center: 'title',
                        end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth,listWeek,listDay'
                    },
                    buttonText: {
                        month: 'Month',
                        week: 'Week',
                        day: 'Day',
                        listMonth: 'Month List',
                        listWeek: 'Week List',
                        listDay: 'Day List'
                    },
                    aspectRatio: '{!! config('bt.schedulerFcAspectRatio') !!}',//1.35 default
                    eventOrder: "-category,start",
                    eventDisplay: 'block',
                    initialDate: "{!! date('Y-m-d') !!}",
                    @if($status == 'last')
                    initialDate: "{!! date('Y-m-d', strtotime("first day of previous month")) !!}",
                    @elseif($status == 'next')
                    initialDate: "{!! date('Y-m-d', strtotime("first day of next month")) !!}",
                    @else
                    initialDate: "{!! date('Y-m-d') !!}",
                    @endif
                    selectable: false,
                    selectMirror: false,
                    @if(config('bt.schedulerCreateWorkorder'))
                        datesSet: function (info) {
                            // Add the "button" to the day headers
                            const $headers = $('.fc-daygrid-day-top');
                            $headers.css('position', 'relative');
                            $headers.prepend("<div id='cwo'><button type='button' id='createWorkorder' class='btn btn-link btn-sm ' style='position: absolute; left: 0' title='@lang('bt.create_workorder')'><i class='createwobutton far fa-file-alt' ></i></button> </div>");
                        },
                    @endif

                    dateClick: function (info) {
                        // If Workorder Button Icon Selected
                        if ($(info.jsEvent.target).hasClass("createwobutton")) {
                            $.ajax(
                                {
                                    url: '/scheduler/getResources/' + moment(info.date).format('YYYY-MM-DD'),
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

                            $('#create-workorder').dialog({
                                autoOpen: false,
                                width: 800,
                                position: {my: 'center top', at: 'center top', of: '.fc-view-harness', collision: 'none'},
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
                                title: "@lang('bt.create_workorder') for @lang('bt.job_date') " + moment(info.date).format('dddd MMMM DD, YYYY'),
                                open: function () {
                                    $("#job_date").val(moment(info.date).format('YYYY-MM-DD'));
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

                            $('#calEventDialog').dialog({
                                autoOpen: false,
                                width: 500,
                                position: {my: 'center top', at: 'center top', of: '.fc-view-harness', collision: 'none'},
                                closeOnEscape: true,
                                modal: true,
                                title: '@lang('bt.create_event_calendar')',
                                open: function () {
                                    $("#title").autocomplete({
                                        appendTo: "#calEventDialog",
                                        source: "/scheduler/ajax/employee",
                                        minLength: 2
                                    }).autocomplete("widget");
                                    $("#title").val('');
                                    $("#description").val('');
                                    $(".from").val(moment(info.date).format('YYYY-MM-DD 08:00'));
                                    $(".to").val(moment(info.date).endOf('day').format('YYYY-MM-DD 09:00'));
                                    $("#category").val(2); //default to general appointment
                                    $("#addReminderShow").html('');
                                    $(this).find("[type=submit]").hide();
                                },
                                buttons: [
                                    {
                                        text: '@lang('bt.create')',
                                        click: function () {
                                            $(this).dialog().find('form').submit();
                                        },
                                        type: 'submit',
                                        form: 'saveCalendarEvent' // <-- Make the association
                                    },
                                    {
                                        text: '@lang('bt.cancel')',
                                        click: function () {
                                            $(this).dialog("close");
                                        }
                                    }
                                ],
                                close: function () {
                                    $("#addReminderCreate").html('<i class="fa fa-plus"></i>@lang('bt.add_reminder')');
                                }
                            });

                            $('#calEventDialog').dialog('open');
                        }
                    },
                    eventClick: function (info) {
                        // added link to core events
                        info.jsEvent.preventDefault();

                        if (info.event.url) {
                            window.open(info.event.url, '_parent');
                            return false;
                        }
                        if (info.event.extendedProps.isrecurring === '1') {
                            window.open('{{ route('scheduler.editrecurringevent') }}' + '/' + info.event.id, '_parent');
                            return false;
                        }

                        $("#addReminderShow").html('');
                        if (info.event.extendedProps.reminder) {
                            let reminderHtml = '';
                            for (let key in info.event.extendedProps.reminder) {

                                reminderHtml += '<div class="reminder_delete_div"><div class="form-group d-flex align-items-center">' +
                                    '<hr class="col-sm-10 hr-clr-green"/>' +
                                    '<span class="col-sm-1 float-right reminder-cross delete_reminder" style="cursor: pointer"><i class="fa fa-times-circle"></i></span>' +
                                    '</div><div class="form-group d-flex align-items-center">' +
                                    '<label for="reminder_date" class="col-sm-4 text-right text">@lang('bt.reminder_date')</label>' +
                                    '<div class="col-sm-8">' +
                                    '<input type="text" name="reminder_date[]" class="form-control reminder_date " style="cursor: pointer" readonly value="' + info.event.extendedProps.reminder[key].reminder_date + '">' +
                                    '<input type="hidden" name="reminder_id[]"  value="' + info.event.extendedProps.reminder[key].reminder_id + '">' +
                                    '</div></div><div class="form-group d-flex align-items-center">' +
                                    '<label for="reminder_location" class="col-sm-4 text-right text">@lang('bt.reminder_location')</label>' +
                                    '<div class="col-sm-8">' +
                                    '<input type="text" name="reminder_location[]" class="form-control" value="' + info.event.extendedProps.reminder[key].reminder_location + '">' +
                                    '</div></div><div class="form-group d-flex align-items-center">' +
                                    '<label for="reminder_text" class="col-sm-4 text-right text">@lang('bt.reminder_text')</label>' +
                                    '<div class="col-sm-8">' +
                                    '<textarea name="reminder_text[]" class="form-control" >' + info.event.extendedProps.reminder[key].reminder_text + '</textarea>' +
                                    '</div></div></div>'
                            }
                            $("#addReminderShow").html(reminderHtml);
                            $("#addReminderCreate").html('<i class="fa fa-plus"></i>@lang('bt.add_another_reminder')');
                        }

                        $('#calEventDialog').dialog({
                            autoOpen: false,
                            width: 500,
                            position: {my: 'center top', at: 'center top', of: '.fc-view-harness', collision: 'none'},
                            closeOnEscape: true,
                            modal: true,
                            title: '@lang('bt.update_event_calendar')',
                            open: function () {
                                $("#title").autocomplete({
                                    appendTo: "#calEventDialog",
                                    source: "/scheduler/ajax/employee",
                                    minLength: 2
                                }).autocomplete("widget");
                                $("#title").val(info.event.title);
                                $("#description").val(info.event.extendedProps.description);
                                $("#id").val(info.event.id);
                                $("#oid").val(info.event.extendedProps.oid);
                                $("#from").val(moment(info.event.start).format("YYYY-MM-DD HH:mm"));
                                $("#to").val(moment(info.event.end).format("YYYY-MM-DD HH:mm"));
                                $("#category").val(info.event.extendedProps.category);//defined inside calendar.blade
                                $(this).find("[type=submit]").hide();
                            },
                            buttons: [
                                {
                                    text: '@lang('bt.update')',
                                    click: function () {
                                        $(this).dialog().find('form').submit();
                                    },
                                    type: 'submit',
                                    form: 'saveCalendarEvent' // <-- Make the association
                                },
                                {
                                    text: '@lang('bt.cancel')',
                                    click: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            ],
                            close: function () {
                                $("#addReminderCreate").html('<i class="fa fa-plus"></i>@lang('bt.add_reminder')');
                            }
                        });
                      $('#calEventDialog').dialog('open');
                    },
                    // added tooltip mouseover
                    eventDidMount: function (info) {
                        let rstr = "";
                        let tooltippy = "";
                        if (info.event.extendedProps.type === 'Workorder') {
                            let wrstr = "@lang('bt.employees'): ";
                            if (info.event.extendedProps.willcall === '1') {
                                wrstr = "<span style='color:magenta'>@lang('bt.employees'): </span>";
                            }
                            let erstr = "Resources: ";
                            if (info.event.extendedProps.hasOwnProperty("resource")) {
                                $.each(info.event.extendedProps.resource, function (key, value) {

                                    if (value.resource_table === 'employees' && value.resource_value) { //employees and not empty
                                        wrstr += " " + value.resource_value;
                                    }
                                    if (value.resource_table === 'products') { // Resources
                                        erstr += " " + value.resource_value;
                                    }
                                });
                            }
                            if ((wrstr === "@lang('bt.employees'): ") || (wrstr === "<span style='color:magenta'>@lang('bt.employees'): </span>")) {
                                wrstr = "";
                            }
                            if (erstr === "Resources: ") {
                                erstr = "";
                            }
                            rstr = wrstr + "<br>" + erstr;
                        }
                        if (info.event.extendedProps.type === 'Workorder' || info.event.extendedProps.type === undefined) {
                            tooltippy = moment(info.event.start).format("MMM DD H:mm") + ' to ' + moment(info.event.end).format("H:mm")
                                + '<br>'
                                + info.event.extendedProps.description
                                + '<br>'
                                + rstr;
                            //themes: light, light-border, material, translucent
                            var tooltip = new Tippy(info.el, {
                                allowHTML: true,
                                content: tooltippy,
                                placement: 'auto',
                                trigger: 'mouseenter focus',
                                appendTo: () => document.body,
                                theme: 'light-border'
                            });
                        }
                    },

                    dayMaxEventRows: parseInt({!! config('bt.schedulerEventLimit') !!}) ? parseInt({!! config('bt.schedulerEventLimit') !!}): false, // allows "more" link when too many events

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
            calendar.render();

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
