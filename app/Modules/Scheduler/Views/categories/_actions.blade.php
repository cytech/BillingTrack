<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('scheduler.categories.edit', [$id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        @if($id > 10)
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('scheduler.categories.delete', [$id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
        @endif
    </ul>
</div>

