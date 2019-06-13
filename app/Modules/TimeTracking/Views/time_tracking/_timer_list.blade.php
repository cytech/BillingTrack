<style>
    .tools {
        display: none;
    }

    .timer-row:hover .tools {
        display: block;
    }
</style>

<table class="table table-hover" style="margin-top: 15px;">
    <thead>
    <tr>
        <th>@lang('bt.start_time')</th>
        <th>@lang('bt.stop_time')</th>
        <th>@lang('bt.hours')</th>
        <th style="width: 5%;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($timers as $timer)
        <tr class="timer-row">
            <td>{{ $timer->formatted_start_at }}</td>
            <td>{{ $timer->formatted_end_at }}</td>
            <td>{{ $timer->formatted_hours }}</td>
            <td>
                @if ($timer->formatted_end_at)
                    <div class="tools" style="font-size: 1.25em;">
                    <a href="javascript:void(0)" class="btn-delete-timer" data-timer-id="{{ $timer->id }}" data-toggle="tooltip" title="@lang('bt.trash_timer')"><i class="fa fa-trash-alt"></i></a>
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
