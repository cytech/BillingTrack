<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('clients.show', [$id]) }}" id="view-client-{{ $id }}"><i
                        class="fa fa-search"></i> @lang('fi.view')</a>
        <a class="dropdown-item" href="{{ route('clients.edit', [$id]) }}" id="edit-client-{{ $id }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <a href ="javascript:void(0)" class="create-quote dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('fi.create_quote')</a>
        <a href ="javascript:void(0)" class="create-workorder dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('fi.create_workorder')</a>
        <a href ="javascript:void(0)" class="create-invoice dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('fi.create_invoice')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('@lang('fi.trash_client_warning')', '{{ route('clients.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>
