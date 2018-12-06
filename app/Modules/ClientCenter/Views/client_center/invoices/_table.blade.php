<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('fi.status')</th>
        <th>@lang('fi.invoice')</th>
        <th>@lang('fi.date')</th>
        <th>@lang('fi.due')</th>
        <th>@lang('fi.summary')</th>
        <th>@lang('fi.total')</th>
        <th>@lang('fi.balance')</th>
        <th>@lang('fi.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoices as $invoice)
        <tr>
            <td>
                <span class="badge badge-{{ $invoiceStatuses[$invoice->invoice_status_id] }}">{{ trans('fi.' . $invoiceStatuses[$invoice->invoice_status_id]) }}</span>
                @if ($invoice->viewed)
                    <span class="badge badge-success">@lang('fi.viewed')</span>
                @else
                    <span class="badge badge-secondary">@lang('fi.not_viewed')</span>
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
                        @lang('fi.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('fi.pdf')</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.show', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('fi.view')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>