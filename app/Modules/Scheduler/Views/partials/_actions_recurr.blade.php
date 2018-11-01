<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ route('scheduler.editrecurringevent', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('scheduler.trashevent', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
    </div>
</div>