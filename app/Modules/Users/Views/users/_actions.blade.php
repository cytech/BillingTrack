<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('users.edit', [$id, $user_type]) }}"><i class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a class="dropdown-item" href ="{{ route('users.password.edit', [$id]) }}"><i class="fa fa-lock"></i> @lang('bt.reset_password')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('users.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
    </div>
</div>
