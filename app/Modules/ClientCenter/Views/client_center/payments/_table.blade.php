<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('fi.date')</th>
        <th>@lang('fi.invoice')</th>
        <th>@lang('fi.summary')</th>
        <th>@lang('fi.amount')</th>
        <th>@lang('fi.payment_method')</th>
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