<div id="recent-payments-widget">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold mb-0">{{ trans('fi.recent_payments') }}</h5>
            </div>
            <div class="card-bodyg">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>{{ trans('fi.client') }}</th>
                        <th>{{ trans('fi.date') }}</th>
                        <th>{{ trans('fi.invoice') }}</th>
                        <th>{{ trans('fi.payment_method') }}</th>
                        <th>{{ trans('fi.amount') }}</th>
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