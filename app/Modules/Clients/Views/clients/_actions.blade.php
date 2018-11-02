<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('clients.show', [$id]) }}" id="view-client-{{ $id }}"><i
                        class="fa fa-search"></i> {{ trans('fi.view') }}</a>
        <a class="dropdown-item" href="{{ route('clients.edit', [$id]) }}" id="edit-client-{{ $id }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <a class="dropdown-item" href ="javascript:void(0)" class="create-quote dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> {{ trans('fi.create_quote') }}</a>
        <a class="dropdown-item" href ="javascript:void(0)" class="create-workorder dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> {{ trans('fi.create_workorder') }}</a>
        <a class="dropdown-item" href ="javascript:void(0)" class="create-invoice dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> {{ trans('fi.create_invoice') }}</a>
        <a class="dropdown-item" href="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('{{ trans('fi.trash_client_warning') }}', '{{ route('clients.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
    </div>
</div>
