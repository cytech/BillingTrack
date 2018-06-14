@extends('layouts.master')

@section('javascript')

    @include('layouts._datepicker')
    @include('layouts._typeahead')
    @include('clients._js_lookup')
    @include('time_tracking._task_list_refresh_js')
    @include('time_tracking._project_edit_totals_refresh')

    <script type="text/javascript">
        $(function () {

            var timers = [];

            $("#due_at").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});

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
                if (!confirm('{!! trans('TimeTracking::lang.confirm_delete_task') !!}')) return false;
                submitTaskDelete([$(this).data('task-id')]);
            });

            $('#btn-bulk-delete-tasks').click(function () {
                var ids = [];
                $('.checkbox-bulk-action:checked').each(function () {
                    ids.push($(this).data('task-id'));
                });
                if (ids.length > 0) {
                    if (!confirm('{!! trans('TimeTracking::lang.confirm_delete_task') !!}')) return false;
                    submitTaskDelete(ids);
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
                var ids = [];
                $('.checkbox-bulk-action:checked').each(function () {
                    ids.push($(this).data('task-id'));
                });
                if (ids.length > 0) {
                    submitTaskBill(ids);
                }
            });

            $(document).on('click', '.btn-bill-task', function() {
                var ids = [];
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
                    notify('{{ trans('fi.settings_successfully_saved') }}', 'success');
                }).fail(function (response) {
                    if (response.status == 400) {
                        $.each($.parseJSON(response.responseText).errors, function (id, message) {
                            notify(message, 'danger');
                        });
                    } else {
                        notify('{{ trans('fi.unknown_error') }}', 'danger');
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
        <h1 class="pull-left">{{ trans('TimeTracking::lang.time_tracking') }}
            <small>{{ $project->name }}</small>
        </h1>
        <div class="pull-right">
            <a href="{{ route('timeTracking.projects.delete', [$project->id]) }}" class="btn btn-default" onclick="return confirm('{{ trans('TimeTracking::lang.confirm_delete_project') }}');"><i class="fa fa-trash"></i> {{ trans('TimeTracking::lang.delete_project') }}</a>
            <a href="{{ route('timeTracking.projects.index') }}" class="btn btn-default"><i class="fa fa-backward"></i> {{ trans('fi.back') }}</a>
            <button class="btn btn-primary" id="btn-save-settings"><i class="fa fa-save"></i> {{ trans('fi.save') }}</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-10">

                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-list"></i>

                        <h3 class="box-title">{{ trans('TimeTracking::lang.tasks') }}</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-primary" id="btn-add-task">
                                <i class="fa fa-plus"></i> {{ trans('TimeTracking::lang.add_task') }}
                            </button>
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ trans('TimeTracking::lang.bulk_actions') }} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)" id="btn-bulk-bill-tasks"><i class="fa fa-dollar"></i> {{ trans('TimeTracking::lang.bill_tasks') }}</a></li>
                                    <li><a href="javascript:void(0)" id="btn-bulk-delete-tasks"><i class="fa fa-trash"></i> {{ trans('TimeTracking::lang.delete_tasks') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <span class="small"><a href="javascript:void(0)" id="btn-bulk-select-all">Select All</a> | <a href="javascript:void(0)" id="btn-bulk-deselect-all">Deselect All</a></span>

                        <ul class="todo-list" id="project-task-list">
                            @include('time_tracking._task_list')
                        </ul>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-list"></i>

                        <h3 class="box-title">{{ trans('TimeTracking::lang.billed_tasks') }}</h3>

                    </div>

                    <div class="box-body no-padding">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('TimeTracking::lang.task') }}</th>
                                <th class="text-right">{{ trans('TimeTracking::lang.hours') }}</th>
                                <th>{{ trans('fi.invoice') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasksBilled as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td class="text-right">{{ $task->formatted_hours }}</td>
                                    <td><a href="{{ route('invoices.edit', [$task->invoice_id]) }}">{{ $task->invoice->number }}</a></td>
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

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title">{{ trans('fi.options') }}</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label>{{ trans('TimeTracking::lang.project_name') }}:</label>
                            {!! Form::text('project_name', $project->name, ['id' => 'project_name', 'class' => 'form-control input-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>{{ trans('fi.company_profile') }}:</label>
                            {!! Form::select('company_profile_id', $companyProfiles, $project->company_profile_id, ['id' => 'company_profile_id', 'class' => 'form-control input-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>* {{ trans('fi.client') }}:</label>
                            {!! Form::text('client_name', $project->client_name, ['id' => 'client_name', 'class' => 'form-control client-lookup input-sm', 'autocomplete' => 'off']) !!}
                        </div>

                        <div class="form-group">
                            <label>* {{ trans('fi.due_date') }}:</label>
                            {!! Form::text('due_at', $project->formatted_due_at, ['id' => 'due_at', 'class' => 'form-control datepicker input-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>{{ trans('TimeTracking::lang.hourly_rate') }}:</label>
                            {!! Form::text('hourly_rate', $project->hourly_rate, ['id' => 'hourly_rate', 'class' => 'form-control input-sm']) !!}
                        </div>

                        <div class="form-group">
                            <label>{{ trans('fi.status') }}:</label>
                            {!! Form::select('status_id', $statuses, $project->status_id, ['id' => 'status_id', 'class' => 'form-control input-sm']) !!}
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

@stop