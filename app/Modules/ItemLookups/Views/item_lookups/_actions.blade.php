<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
            data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item"
           href="{{ route('itemLookups.edit', [$id]) }}"><i
                    class="fa fa-edit"></i> @lang('bt.edit')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"
           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('itemLookups.delete', [$id]) }}');"><i
                    class="fa fa-trash-alt btn-danger"></i> @lang('bt.delete')</a>
    </div>
</div>
