<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('scheduler.categories.edit', [$id]) }}"><i class="fa fa-edit"></i> @lang('bt.edit')</a>
        @if($id > 10)
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('scheduler.categories.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
        @endif
    </div>
</div>

