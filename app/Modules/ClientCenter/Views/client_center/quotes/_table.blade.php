<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('bt.status')</th>
        <th>@lang('bt.quote')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.expires')</th>
        <th>@lang('bt.summary')</th>
        <th>@lang('bt.total')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($quotes as $quote)
        <tr>
            <td>
                <span class="badge badge-{{ $quoteStatuses[$quote->quote_status_id] }}">{{ trans('bt.' . $quoteStatuses[$quote->quote_status_id]) }}</span>
                @if ($quote->viewed)
                    <span class="badge badge-success">@lang('bt.viewed')</span>
                @else
                    <span class="badge badge-secondary">@lang('bt.not_viewed')</span>
                @endif
            </td>
            <td>{{ $quote->number }}</td>
            <td>{{ $quote->formatted_created_at }}</td>
            <td>{{ $quote->formatted_expires_at }}</td>
            <td>{{ $quote->summary }}</td>
            <td>{{ $quote->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('clientCenter.public.quote.pdf', [$quote->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.quote.show', [$quote->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('bt.view')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
