<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('scheduler.tableeventedit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('fi.trash_record_warning')', '{{ route('scheduler.trashevent', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>