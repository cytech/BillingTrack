<table class="table table-hover" style="height: 100%;">

    <thead>
    <tr>
        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
        <th>{{ trans('fi.status') }}</th>
        <th>{{ trans('fi.quote') }}</th>
        <th>{{ trans('fi.date') }}</th>
        <th>{{ trans('fi.expires') }}</th>
        <th>{{ trans('fi.client') }}</th>
        <th>{{ trans('fi.summary') }}</th>
        <th style="text-align: right; padding-right: 25px;">{{ trans('fi.total') }}</th>
        <th>{{ trans('fi.invoiced') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($quotes as $quote)
        <tr>
            <td><input type="checkbox" class="bulk-record" data-id="{{ $quote->id }}"></td>
            <td>
                <span class="badge badge-{{ $statuses[$quote->quote_status_id] }}">{{ trans('fi.' . $statuses[$quote->quote_status_id]) }}</span>
                @if ($quote->viewed)
                    <span class="badge badge-success">{{ trans('fi.viewed') }}</span>
                @else
                    <span class="badge badge-secondary">{{ trans('fi.not_viewed') }}</span>
                @endif
            </td>
            <td><a href="{{ route('quotes.edit', [$quote->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $quote->number }}</a></td>
            <td>{{ $quote->formatted_quote_date }}</td>
            <td>{{ $quote->formatted_expires_at }}</td>
            <td><a href="{{ route('clients.show', [$quote->client->id]) }}"
                   title="{{ trans('fi.view_client') }}">{{ $quote->client->unique_name }}</a></td>
            <td>{{ mb_strimwidth($quote->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $quote->amount->formatted_total }}</td>
            <td>
                @if ($quote->invoice)
                    <a href="{{ route('invoices.edit', [$quote->invoice_id]) }}">{{ trans('fi.invoice') }}</a>
                @elseif ($quote->workorder)
                    <a href="{{ route('workorders.edit', [$quote->workorder_id]) }}">{{ trans('fi.workorder') }}</a>
                @else
                    {{ trans('fi.no') }}
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }}
                    </button>
                    <div  class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('quotes.edit', [$quote->id]) }}"><i
                                    class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
                        <a class="dropdown-item" href="{{ route('quotes.pdf', [$quote->id]) }}" target="_blank" id="btn-pdf-quote"><i
                                    class="fa fa-print"></i> {{ trans('fi.pdf') }}</a>
                        <a href="javascript:void(0)" class="email-quote dropdown-item" data-quote-id="{{ $quote->id }}"
                               data-redirect-to="{{ request()->fullUrl() }}"><i
                                    class="fa fa-envelope"></i> {{ trans('fi.email') }}</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.quote.show', [$quote->url_key]) }}" target="_blank"
                               id="btn-public-quote"><i class="fa fa-globe"></i> {{ trans('fi.public') }}</a>
                        <a class="dropdown-item" href="#"
                               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}','{{ route('quotes.delete', [$quote->id]) }}');"><i
                                    class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>