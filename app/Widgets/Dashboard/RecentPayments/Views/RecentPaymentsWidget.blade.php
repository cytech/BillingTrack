<div id="recent-payments-widget">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('fi.recent_payments')</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>@lang('fi.client')</th>
                        <th>@lang('fi.date')</th>
                        <th>@lang('fi.invoice')</th>
                        <th>@lang('fi.payment_method')</th>
                        <th>@lang('fi.amount')</th>
                    </tr>
                    @foreach ($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->client->unique_name }}</td>
                            <td>{!! $payment->formatted_paid_at !!}</td>
                            <td><a href="{!! url('/invoices') . '/' .  $payment->invoice->id . '/edit' !!}">
                                    {{ $payment->invoice->number }}</a></td>
                            <td>{!! $payment->paymentMethod->name !!}</td>
                            <td>{!! $payment->formatted_amount !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>