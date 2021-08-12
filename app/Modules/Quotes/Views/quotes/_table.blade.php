<table class="table table-hover" style="height: 100%;">

    <thead>
    <tr>
{{--        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>--}}
        <th>@lang('bt.status')</th>
        <th>@lang('bt.quote')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.expires')</th>
        <th>@lang('bt.client')</th>
        <th>@lang('bt.summary')</th>
        <th style="text-align: right; padding-right: 25px;">@lang('bt.total')</th>
        <th>@lang('bt.invoiced')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($quotes as $quote)
        <tr>
{{--            <td><input type="checkbox" class="bulk-record" data-id="{{ $quote->id }}"></td>--}}
            <td>
                <span class="badge badge-{{ $statuses[$quote->quote_status_id] }}">{{ trans('bt.' . $statuses[$quote->quote_status_id]) }}</span>
                @if ($quote->viewed)
                    <span class="badge badge-success">@lang('bt.viewed')</span>
                @else
                    <span class="badge badge-secondary">@lang('bt.not_viewed')</span>
                @endif
            </td>
            <td><a href="{{ route('quotes.edit', [$quote->id]) }}"
                   title="@lang('bt.edit')">{{ $quote->number }}</a></td>
            <td>{{ $quote->formatted_quote_date }}</td>
            <td>{{ $quote->formatted_expires_at }}</td>
            <td><a href="{{ route('clients.show', [$quote->client->id]) }}"
                   title="@lang('bt.view_client')">{{ $quote->client->unique_name }}</a></td>
            <td>{{ mb_strimwidth($quote->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $quote->amount->formatted_total }}</td>
            <td>
                @if ($quote->invoice)
                    <a href="{{ route('invoices.edit', [$quote->invoice_id]) }}">@lang('bt.invoice')</a>
                @elseif ($quote->workorder)
                    <a href="{{ route('workorders.edit', [$quote->workorder_id]) }}">@lang('bt.workorder')</a>
                @else
                    @lang('bt.no')
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div  class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('quotes.edit', [$quote->id]) }}"><i
                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                        <a class="dropdown-item" href="{{ route('quotes.pdf', [$quote->id]) }}" target="_blank" id="btn-pdf-quote"><i
                                    class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a href="javascript:void(0)" class="email-quote dropdown-item" data-quote-id="{{ $quote->id }}"
                               data-redirect-to="{{ request()->fullUrl() }}"><i
                                    class="fa fa-envelope"></i> @lang('bt.email')</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.quote.show', [$quote->url_key]) }}" target="_blank"
                               id="btn-public-quote"><i class="fa fa-globe"></i> @lang('bt.public')</a>
                        <a class="dropdown-item" href="#"
                               onclick="swalConfirm('@lang('bt.trash_record_warning')', '','{{ route('quotes.delete', [$quote->id]) }}');"><i
                                    class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
