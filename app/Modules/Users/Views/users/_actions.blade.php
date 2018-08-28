<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('users.edit', [$id, $user_type]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="{{ route('users.password.edit', [$id]) }}"><i class="fa fa-lock"></i> {{ trans('fi.reset_password') }}</a></li>
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('users.delete', [$id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
    </ul>
</div>