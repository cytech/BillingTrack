<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li>
            {{--<a href="{{ route('utilities.restore_trash', [$model->id, 'entity' => substr(strrchr(get_class($model), '\\'), 1)]) }}"><i--}}
            <a href="{{ route('utilities.restore_trash', [$model->id, 'entity' => get_class($model)]) }}"><i
                        class="fa fa-edit"></i>@lang('fi.restore')</a></li>
        <li><a href="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('{{ trans('fi.trash_deletesingle_warning') }}', '{{ route('utilities.delete_trash',
                                    [$model->id, 'entity' => get_class($model)]) }}');"><i
                        class="btn-danger fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
    </ul>
</div>
