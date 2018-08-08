<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ trans('fi.status') }}</th>
        <th>{{ trans('fi.workorder') }}</th>
        <th>{{ trans('fi.date') }}</th>
        <th>{{ trans('fi.expires') }}</th>
        <th>{{ trans('fi.summary') }}</th>
        <th>{{ trans('fi.total') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($workorders as $workorder)
        <tr>
            <td>
                <span class="label label-{{ $workorderStatuses[$workorder->workorder_status_id] }}">{{ trans('fi.' . $workorderStatuses[$workorder->workorder_status_id]) }}</span>
                @if ($workorder->viewed)
                    <span class="label label-success">{{ trans('fi.viewed') }}</span>
                @else
                    <span class="label label-default">{{ trans('fi.not_viewed') }}</span>
                @endif
            </td>
            <td>{{ $workorder->number }}</td>
            <td>{{ $workorder->formatted_created_at }}</td>
            <td>{{ $workorder->formatted_expires_at }}</td>
            <td>{{ $workorder->summary }}</td>
            <td>{{ $workorder->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('clientCenter.public.workorder.pdf', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a></li>
                        <li><a href="{{ route('clientCenter.public.workorder.show', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-search"></i> {{ trans('fi.view') }}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>