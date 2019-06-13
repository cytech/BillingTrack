@if ($tasks->count() == 0)
    <li>@lang('bt.task_notice')</li>
@else
    @foreach ($tasks as $task)
        <li id="task_id_{{ $task->id }}">
            <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>

            <input type="checkbox" class="checkbox-bulk-action" data-task-id="{{ $task->id }}">

            @if (!$task->activeTimer)
                <button class="btn btn-sm bg-green btn-start-timer" data-task-id="{{ $task->id }}"><i class="fa fa-play"></i> <strong>@lang('bt.start_timer')<br>
                    {{ $task->formatted_hours }} @lang('bt.hours')</strong>
                </button>
            @else
                <button class="btn btn-sm bg-red btn-stop-timer" data-timer-id="{{ $task->activeTimer->id }}" data-task-id="{{ $task->id }}"><i class="fa fa-stop"></i> <strong>@lang('bt.stop_timer')<br>
                    <span id="hours_{{ $task->id }}">00</span>:<span id="minutes_{{ $task->id }}">00</span>:<span id="seconds_{{ $task->id }}">00</span></strong>
                </button>
            @endif

            <span class="text">{{ $task->name }}</span>

            <div class="tools" style="font-size: 1.25em;">
                <a href="javascript:void(0)" class="btn-show-timers" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="@lang('bt.show_timers')"><i class="fa fa-clock"></i></a>
                <a href="javascript:void(0)" class="btn-bill-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="@lang('bt.bill_task')"><i class="fa fa-dollar-sign"></i></a>
                <a href="javascript:void(0)" class="btn-edit-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="@lang('bt.edit_task')"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn-delete-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="@lang('bt.trash_task')"><i class="fa fa-trash-alt"></i></a>
            </div>
        </li>
    @endforeach
@endif
