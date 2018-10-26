@if ($tasks->count() == 0)
    <li>{{ trans('fi.task_notice') }}</li>
@else
    @foreach ($tasks as $task)
        <li id="task_id_{{ $task->id }}">
            <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>

            <input type="checkbox" class="checkbox-bulk-action" data-task-id="{{ $task->id }}">

            @if (!$task->activeTimer)
                <button class="btn btn-sm bg-green btn-start-timer" data-task-id="{{ $task->id }}"><i class="fa fa-play"></i> <strong>{{ trans('fi.start_timer') }}<br>
                    {{ $task->formatted_hours }} {{ trans('fi.hours') }}</strong>
                </button>
            @else
                <button class="btn btn-sm bg-red btn-stop-timer" data-timer-id="{{ $task->activeTimer->id }}" data-task-id="{{ $task->id }}"><i class="fa fa-stop"></i> <strong>{{ trans('fi.stop_timer') }}<br>
                    <span id="hours_{{ $task->id }}">00</span>:<span id="minutes_{{ $task->id }}">00</span>:<span id="seconds_{{ $task->id }}">00</span></strong>
                </button>
            @endif

            <span class="text">{{ $task->name }}</span>

            <div class="tools" style="font-size: 1.25em;">
                <a href="javascript:void(0)" class="btn-show-timers" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="{{ trans('fi.show_timers') }}"><i class="fa fa-clock-o"></i></a>
                <a href="javascript:void(0)" class="btn-bill-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="{{ trans('fi.bill_task') }}"><i class="fa fa-dollar"></i></a>
                <a href="javascript:void(0)" class="btn-edit-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="{{ trans('fi.edit_task') }}"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn-delete-task" data-task-id="{{ $task->id }}" data-toggle="tooltip" title="{{ trans('fi.trash_task') }}"><i class="fa fa-trash-alt"></i></a>
            </div>
        </li>
    @endforeach
@endif