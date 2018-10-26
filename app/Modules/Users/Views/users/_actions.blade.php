<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('users.edit', [$id, $user_type]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <a class="dropdown-item" href ="{{ route('users.password.edit', [$id]) }}"><i class="fa fa-lock"></i> {{ trans('fi.reset_password') }}</a>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('users.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
    </div>
</div>