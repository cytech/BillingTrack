<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('timeTracking.projects.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('fi.confirm_trash_project')', '{{ route('timeTracking.projects.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>