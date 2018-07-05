<div class="box box-primary">

    <div class="box-body no-padding">
        <table class="table table-hover">

            <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('fi.invoice') }}</th>
                <th>{{ trans('fi.payment_method') }}</th>
                <th>{{ trans('fi.amount') }}</th>
                <th>Date Trashed</th>
                <th>{{ trans('fi.options') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->invoice->number }}</td>
                    <td>{{ $payment->paymentMethod->name }}</td>
                    <td>{{ $payment->formatted_amount }}</td>
                    <td>{{ $payment->deleted_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-default btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                {{ trans('fi.options') }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{ route('utilities.restore_trash', [$payment->id, 'entity' => 'payment']) }}"><i
                                                class="fa fa-edit"></i> Restore</a></li>
                                {{--<li><a href="{{ route('users.password.edit', [$payment->id]) }}"><i class="fa fa-lock"></i> {{ trans('fi.reset_password') }}</a></li>--}}
                                {{--<li><a href="#"--}}
                                {{--onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('users.delete', [$payment->id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>--}}
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>