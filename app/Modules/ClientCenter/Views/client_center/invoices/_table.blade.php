<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('bt.status')</th>
        <th>@lang('bt.invoice')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.due')</th>
        <th>@lang('bt.summary')</th>
        <th>@lang('bt.total')</th>
        <th>@lang('bt.balance')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoices as $invoice)
        <tr>
            <td>
                <span class="badge badge-{{ $invoiceStatuses[$invoice->invoice_status_id] }}">{{ trans('bt.' . $invoiceStatuses[$invoice->invoice_status_id]) }}</span>
                @if ($invoice->viewed)
                    <span class="badge badge-success">@lang('bt.viewed')</span>
                @else
                    <span class="badge badge-secondary">@lang('bt.not_viewed')</span>
                @endif
            </td>
            <td>{{ $invoice->number }}</td>
            <td>{{ $invoice->formatted_created_at }}</td>
            <td>{{ $invoice->formatted_due_at }}</td>
            <td>{{ $invoice->summary }}</td>
            <td>{{ $invoice->amount->formatted_total }}</td>
            <td>{{ $invoice->amount->formatted_balance }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.show', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('bt.view')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
