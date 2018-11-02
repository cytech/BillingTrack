<table class="table table-hover">

    <thead>
    <tr>
        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
        <th>{{ trans('fi.status') }}</th>
        <th>{{ trans('fi.invoice')}}</th>
        <th>{{ trans('fi.date')}}</th>
        <th>{{ trans('fi.due')}}</th>
        <th>{{ trans('fi.client')}}</th>
        <th>{{ trans('fi.summary')}}</th>
        <th style="text-align: right; padding-right: 25px;">{{ trans('fi.total')}}</th>
        <th style="text-align: right; padding-right: 25px;">{{ trans('fi.balance')}}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($invoices as $invoice)
        <tr>
            <td><input type="checkbox" class="bulk-record" data-id="{{ $invoice->id }}"></td>
            <td>
                <span class="badge badge-{{ $statuses[$invoice->invoice_status_id] }}">{{ trans('fi.' . $statuses[$invoice->invoice_status_id]) }}</span>
                @if ($invoice->viewed)
                    <span class="badge badge-success">{{ trans('fi.viewed') }}</span>
                @else
                    <span class="badge badge-secondary">{{ trans('fi.not_viewed') }}</span>
                @endif
            </td>
            <td><a href="{{ route('invoices.edit', [$invoice->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $invoice->number }}</a></td>
            <td>{{ $invoice->formatted_invoice_date }}</td>
            <td @if ($invoice->isOverdue) style="color: red; font-weight: bold;" @endif>{{ $invoice->formatted_due_at }}</td>
            <td><a href="{{ route('clients.show', [$invoice->client->id]) }}"
                   title="{{ trans('fi.view_client') }}">{{ $invoice->client->unique_name }}</a></td>
            <td>{{ mb_strimwidth($invoice->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $invoice->amount->formatted_total }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $invoice->amount->formatted_balance }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('invoices.edit', [$invoice->id]) }}"><i
                                    class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
                        <a class="dropdown-item" href="{{ route('invoices.pdf', [$invoice->id]) }}" target="_blank"
                               id="btn-pdf-invoice"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a>
                        <a href="javascript:void(0)" class="email-invoice dropdown-item" data-invoice-id="{{ $invoice->id }}"
                               data-redirect-to="{{ request()->fullUrl() }}"><i
                                    class="fa fa-envelope"></i> {{ trans('fi.email') }}</a>
                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.show', [$invoice->url_key]) }}"
                               target="_blank" id="btn-public-invoice"><i
                                    class="fa fa-globe"></i> {{ trans('fi.public') }}</a>
                        @if ($invoice->isPayable or config('fi.allowPaymentsWithoutBalance'))
                            <a href="javascript:void(0)" id="btn-enter-payment" class="enter-payment dropdown-item"
                                   data-invoice-id="{{ $invoice->id }}"
                                   data-invoice-balance="{{ $invoice->amount->formatted_numeric_balance }}"
                                   data-redirect-to="{{ request()->fullUrl() }}"><i
                                        class="fa fa-credit-card"></i> {{ trans('fi.enter_payment') }}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('invoices.delete', [$invoice->id]) }}"
                               onclick="return confirm('{{ trans('fi.trash_record_warning') }}');"><i
                                    class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>