<div class="box box-primary">

    <div class="box-body no-padding">
        <table class="table table-hover">

            <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('fi.name') }}</th>
                <th>{{ trans('fi.email') }}</th>
                <th>Date Trashed</th>
                <th>{{ trans('fi.options') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->deleted_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-default btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                {{ trans('fi.options') }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{ route('utilities.restore_trash', [$client->id, 'entity' => 'client']) }}"><i
                                                class="fa fa-edit"></i> Restore</a></li>
                                {{--<li><a href="{{ route('users.password.edit', [$client->id]) }}"><i class="fa fa-lock"></i> {{ trans('fi.reset_password') }}</a></li>--}}
                                {{--<li><a href="#"--}}
                                {{--onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('users.delete', [$client->id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>--}}
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>