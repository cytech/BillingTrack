<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('scheduler.tableeventedit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('scheduler.trashevent', [$id]) }}');"><i
                        class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
    </ul>
</div>