@extends('layouts.master')

@section('javaScript')


    {{--@include('layouts._typeahead')--}}
    {{--@include('clients._js_lookup')--}}
    @include('time_tracking._task_list_refresh_js')
    @include('time_tracking._project_edit_totals_refresh')

    <script type="text/javascript">
        $(function () {

            const timers = [];

            $("#due_at").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});

            $('#btn-add-task').click(function () {
                $('#modal-placeholder').load('{{ route('timeTracking.tasks.create') }}', {
                    project_id: {{ $project->id }}
                });
            });

            $("#project-task-list").sortable({
                deactivate: function (event, ui) {
                    $.post('{{ route('timeTracking.tasks.updateDisplayOrder') }}', {
                        task_ids: $('#project-task-list').sortable('toArray')
                    });
                },
                placeholder: "sort-highlight",
                handle: ".handle",
                forcePlaceholderSize: true,
                zIndex: 999999
            });

            $(document).on('click', '.btn-delete-task', function () {
                Swal.fire({
                    title: '@lang('bt.confirm_trash_task')',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d68500',
                    confirmButtonText: '@lang('bt.yes_sure')'
                }).then((result) => {
                    if (result.value) {
                        submitTaskDelete([$(this).data('task-id')]);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {

                    }
                });
            });

            $('#btn-bulk-delete-tasks').click(function () {
                const ids = [];
                $('.checkbox-bulk-action:checked').each(function () {
                    ids.push($(this).data('task-id'));
                });
                if (ids.length > 0) {
                    Swal.fire({
                        title: '@lang('bt.confirm_trash_task')',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d68500',
                        confirmButtonText: '@lang('bt.yes_sure')'
                    }).then((result) => {
                        if (result.value) {
                            submitTaskDelete(ids);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {

                        }
                    });
                }
            });

            $('#btn-bulk-select-all').click(function() {
                $('.checkbox-bulk-action').prop('checked', true);
            });

            $('#btn-bulk-deselect-all').click(function() {
                $('.checkbox-bulk-action').prop('checked', false);
            });

            function submitTaskDelete(ids) {
                $.post('{{ route('timeTracking.tasks.delete') }}', {
                    ids: ids
                }).done(function () {
                    refreshTaskList();
                    refreshTotals();
                });
            }

            $('#btn-bulk-bill-tasks').click(function () {
                const ids = [];
                $('.checkbox-bulk-action:checked').each(function () {
                    ids.push($(this).data('task-id'));
                });
                if (ids.length > 0) {
                    submitTaskBill(ids);
                }
            });

            $(document).on('click', '.btn-bill-task', function() {
                const ids = [];
                ids.push($(this).data('task-id'));

                if (ids.length > 0) {
                    submitTaskBill(ids);
                }
            });

            function submitTaskBill(ids) {
                $('#modal-placeholder').load('{{ route('timeTracking.bill.create') }}', {
                    projectId: {{ $project->id }},
                    taskIds: JSON.stringify(ids)
                });
            }

            $(document).on('click', '.btn-start-timer', function () {
                taskId = $(this).data('task-id');
                $.post('{{ route('timeTracking.timers.start') }}', {
                    task_id: taskId
                }).done(function () {
                    refreshTaskList();
                    startTimer(taskId);
                });
            });

            $(document).on('click', '.btn-stop-timer', function () {
                clearInterval(timers[$(this).data('task-id')]);
                $.post('{{ route('timeTracking.timers.stop') }}', {
                    timer_id: $(this).data('timer-id')
                }).done(function () {
                    refreshTaskList();
                    refreshTotals();
                });
            });

            $(document).on('click', '.btn-edit-task', function () {
                $('#modal-placeholder').load('{{ route('timeTracking.tasks.edit') }}', {
                    id: $(this).data('task-id')
                });
            });

            $(document).on('click', '.btn-show-timers', function () {
                $('#modal-placeholder').load('{{ route('timeTracking.timers.show') }}', {
                    time_tracking_task_id: $(this).data('task-id')
                });
            });

            $('#btn-save-settings').click(function () {

                $.post('{{ route('timeTracking.projects.update', [$project->id]) }}', {
                    name: $('#project_name').val(),
                    company_profile_id: $('#company_profile_id').val(),
                    client_name: $('#client_name').val(),
                    hourly_rate: $('#hourly_rate').val(),
                    status_id: $('#status_id').val(),
                    due_at: $('#due_at').val()
                }).done(function () {
                    notify('@lang('bt.settings_successfully_saved')', 'success');
                }).fail(function (response) {
                    if (response.status == 422) {
                        let msg = '';
                        $.each($.parseJSON(response.responseText).errors, function (id, message) {
                            msg += message + '\n';
                        });
                        notify(msg, 'error');
                    } else {
                        notify('@lang('bt.unknown_error')', 'error');
                    }
                });
            });

            function startTimer(taskId) {
                $.post('{{ route('timeTracking.timers.seconds') }}', {
                    task_id: taskId
                }).done(function (sec) {
                    setTimerInterval(taskId, sec);
                });
            }

            function pad(val) {
                return val > 9 ? val : "0" + val;
            }

            function setTimerInterval(taskId, sec) {
                timerInterval = setInterval(function () {
                    $("#seconds_" + taskId).html(pad(++sec % 60));
                    $("#minutes_" + taskId).html(pad(parseInt(sec / 60 % 60, 10)));
                    $('#hours_' + taskId).html(pad(parseInt(sec / 60 / 60, 10)));
                }, 1000);

                timers[taskId] = timerInterval;
            }

            @foreach ($tasks as $task)
            @if ($task->activeTimer)
            startTimer({{ $task->id }});
            @endif
            @endforeach
        });
    </script>

@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">@lang('bt.time_tracking')
            <small>{{ $project->name }}</small>
        </h3>
        <div class="float-right">
            <a href="#" class="btn btn-secondary"
                   onclick="swalConfirm('@lang('bt.confirm_trash_project')', '', '{{ route('timeTracking.projects.delete', [$project->id]) }}');"><i
                            class="fa fa-trash-alt"></i> @lang('bt.trash_project')</a>
            <a href="{{ route('timeTracking.projects.index') }}" class="btn btn-secondary"><i class="fa fa-backward"></i> @lang('bt.back')</a>
            <button class="btn btn-primary" id="btn-save-settings"><i class="fa fa-save"></i> @lang('bt.save')</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        <div class="row">

            <div class="col-lg-10">

                <div class="card card-light">
                    <div class="card-header">

                        <h3 class="card-title"><i class="fa fa-list"></i> @lang('bt.tasks')</h3>

                        <div class="card-tools float-right">
                            <button class="btn btn-sm btn-primary" id="btn-add-task">
                                <i class="fa fa-plus"></i> @lang('bt.add_task')
                            </button>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    @lang('bt.bulk_actions')
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" id="btn-bulk-bill-tasks"><i class="fa fa-dollar-sign"></i> @lang('bt.bill_tasks')</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" id="btn-bulk-delete-tasks"><i class="fa fa-trash"></i> @lang('bt.trash_tasks')</a>
                                </div>
                            </div>
                        </div>

                        <span class="small"><a href="javascript:void(0)" id="btn-bulk-select-all">Select All</a> | <a href="javascript:void(0)" id="btn-bulk-deselect-all">Deselect All</a></span>

                        <ul class="todo-list" id="project-task-list">
                            @include('time_tracking._task_list')
                        </ul>
                    </div>
                </div>

                <div class="card card-light">
                    <div class="card-header">


                        <h3 class="card-title"><i class="fa fa-list"></i> @lang('bt.billed_tasks')</h3>

                    </div>

                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>@lang('bt.task')</th>
                                <th class="text-right">@lang('bt.hours')</th>
                                <th>@lang('bt.invoice')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasksBilled as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td class="text-right">{{ $task->formatted_hours }}</td>
                                    @if(empty($task->invoice->number))
                                        <td style="color:red">Invoice #{{$task->invoice_id}} Trashed</td>
                                    @else
                                    <td><a href="{{ route('invoices.edit', [$task->invoice_id]) }}">{{ $task->invoice->number }}</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-lg-2">

                <div id="div-totals">
                    @include('time_tracking._project_edit_totals')
                </div>

                <div class="card card-light">

                    <div class="card-header">
                        <h3 class="card-title">@lang('bt.options')</h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>@lang('bt.project_name'):</label>
                            {!! Form::text('project_name', $project->name, ['id' => 'project_name', 'class' => 'form-control form-control-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>@lang('bt.company_profile'):</label>
                            {!! Form::select('company_profile_id', $companyProfiles, $project->company_profile_id, ['id' => 'company_profile_id', 'class' => 'form-control form-control-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>* @lang('bt.client'):</label>
                            {!! Form::text('client_name', $project->client_name, ['id' => 'client_name', 'class' => 'form-control client-lookup form-control-sm', 'autocomplete' => 'off']) !!}
                            <script>
                            $('.client-lookup').autocomplete({
                            appendTo: '#create-quote',
                            source: '{{ route('clients.ajax.lookup') }}',
                            minLength: 3
                            }).autocomplete("widget");
                            </script>
                        </div>

                        <div class="form-group">
                            <label>* @lang('bt.due_date'):</label>
                            {!! Form::text('due_at', $project->formatted_due_at, ['id' => 'due_at', 'class' => 'form-control datepicker form-control-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>@lang('bt.hourly_rate'):</label>
                            {!! Form::text('hourly_rate', $project->hourly_rate, ['id' => 'hourly_rate', 'class' => 'form-control form-control-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>@lang('bt.status'):</label>
                            {!! Form::select('status_id', $statuses, $project->status_id, ['id' => 'status_id', 'class' => 'form-control form-control-sm']) !!}
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

@stop
