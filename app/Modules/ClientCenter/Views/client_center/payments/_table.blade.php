<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.invoice')</th>
        <th>@lang('bt.summary')</th>
        <th>@lang('bt.amount')</th>
        <th>@lang('bt.payment_method')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment->formatted_paid_at }}</td>
            <td>{{ $payment->invoice->number }}</td>
            <td>{{ $payment->invoice->summary }}</td>
            <td>{{ $payment->formatted_amount }}</td>
            <td>{{ $payment->paymentMethod->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
