<div id="recent-payments-widget">
    <section class="content">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">{{ trans('fi.recent_payments') }}</h3>
            </div>
            <div class="box-body no-padding">
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