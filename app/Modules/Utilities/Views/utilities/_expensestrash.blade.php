<div class="box box-primary">

    <div class="box-body no-padding">
        <table class="table table-hover">

            <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('fi.date') }}</th>
                <th>{{ trans('fi.description') }}</th>
                <th>{{ trans('fi.amount') }}</th>
                <th>Date Trashed</th>
                <th>{{ trans('fi.options') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->expense_date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->deleted_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-default btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                {{ trans('fi.options') }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{ route('utilities.restore_trash', [$expense->id, 'entity' => 'expense']) }}"><i
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