<table class="table table-hover">

    <thead>
    <tr>
        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
        <th>{{ trans('fi.payment_date') }}</th>
        <th>{{ trans('fi.invoice') }}</th>
        <th>{{ trans('fi.date') }}</th>
        <th>{{ trans('fi.client') }}</th>
        <th>{{ trans('fi.summary') }}</th>
        <th>{{ trans('fi.amount') }}</th>
        <th>{{ trans('fi.payment_method') }}</th>
        <th>{{ trans('fi.note') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($payments as $payment)
        <tr>
            <td><input type="checkbox" class="bulk-record" data-id="{{ $payment->id }}"></td>
            <td>{{ $payment->formatted_paid_at }}</td>
            <td><a href="{{ route('invoices.edit', [$payment->invoice_id]) }}">{{ $payment->invoice->number }}</a></td>
            <td>{{ $payment->invoice->formatted_created_at }}</td>
            <td><a href="{{ route('clients.show', [$payment->invoice->client_id]) }}">{{ $payment->invoice->client->name }}</a></td>
            <td>{{ $payment->invoice->summary }}</td>
            <td>{{ $payment->formatted_amount }}</td>
            <td>@if ($payment->paymentMethod) {{ $payment->paymentMethod->name }} @endif</td>
            <td>{{ $payment->note }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('payments.edit', [$payment->id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
                        <a class="dropdown-item" href="{{ route('invoices.pdf', [$payment->invoice->id]) }}" target="_blank" id="btn-pdf-invoice"><i class="fa fa-print"></i> {{ trans('fi.invoice') }}</a>
                        @if (config('fi.mailConfigured'))
                            <a href="javascript:void(0)" class="email-payment-receipt dropdown-item" data-payment-id="{{ $payment->id }}" data-redirect-to="{{ request()->fullUrl() }}"><i class="fa fa-envelope"></i> {{ trans('fi.email_payment_receipt') }}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('payments.delete', [$payment->id]) }}" onclick="return confirm('{{ trans('fi.trash_record_warning') }}');"><i class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>