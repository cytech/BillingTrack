<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">

            {{--<a class="dropdown-item" href ="{{ route('utilities.restore_trash', [$model->id, 'entity' => substr(strrchr(get_class($model), '\\'), 1)]) }}"><i--}}
            <a class="dropdown-item" href ="{{ route('utilities.restore_trash', [$model->id, 'entity' => get_class($model)]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.restore')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('@lang('bt.trash_deletesingle_warning')', '', '{{ route('utilities.delete_trash',
                                    [$model->id, 'entity' => get_class($model)]) }}');"><i
                        class="btn-danger fa fa-trash-alt"></i> @lang('bt.delete')</a>
    </div>
</div>
