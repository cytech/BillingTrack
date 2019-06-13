<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('bt.status')</th>
        <th>@lang('bt.workorder')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.expires')</th>
        <th>@lang('bt.summary')</th>
        <th>@lang('bt.total')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($workorders as $workorder)
        <tr>
            <td>
                <span class="badge badge-{{ $workorderStatuses[$workorder->workorder_status_id] }}">{{ trans('bt.' . $workorderStatuses[$workorder->workorder_status_id]) }}</span>
                @if ($workorder->viewed)
                    <span class="badge badge-success">@lang('bt.viewed')</span>
                @else
                    <span class="badge badge-secondary">@lang('bt.not_viewed')</span>
                @endif
            </td>
            <td>{{ $workorder->number }}</td>
            <td>{{ $workorder->formatted_created_at }}</td>
            <td>{{ $workorder->formatted_expires_at }}</td>
            <td>{{ $workorder->summary }}</td>
            <td>{{ $workorder->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('clientCenter.public.workorder.pdf', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.workorder.show', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('bt.view')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
