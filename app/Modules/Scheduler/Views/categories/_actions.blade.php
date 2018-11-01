<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('scheduler.categories.edit', [$id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        @if($id > 10)
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('scheduler.categories.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
        @endif
    </div>
</div>

