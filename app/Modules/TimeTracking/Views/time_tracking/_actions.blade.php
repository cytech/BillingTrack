<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('timeTracking.projects.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.confirm_trash_project')', '', '{{ route('timeTracking.projects.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
