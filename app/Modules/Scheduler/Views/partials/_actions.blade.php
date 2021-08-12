<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('scheduler.tableeventedit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('scheduler.trashevent', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
