<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">

            {{--<a class="dropdown-item" href ="{{ route('utilities.restore_trash', [$model->id, 'entity' => substr(strrchr(get_class($model), '\\'), 1)]) }}"><i--}}
            <a class="dropdown-item" href ="{{ route('utilities.restore_trash', [$model->id, 'entity' => get_class($model)]) }}"><i
                        class="fa fa-edit"></i> @lang('fi.restore')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('{{ trans('fi.trash_deletesingle_warning') }}', '{{ route('utilities.delete_trash',
                                    [$model->id, 'entity' => get_class($model)]) }}');"><i
                        class="btn-danger fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
    </div>
</div>
