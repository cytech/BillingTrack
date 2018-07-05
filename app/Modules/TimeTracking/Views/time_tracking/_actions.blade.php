<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('timeTracking.projects.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.confirm_delete_project') }}', '{{ route('timeTracking.projects.delete', [$id]) }}');"><i
                        class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
    </ul>
</div>