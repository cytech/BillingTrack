<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('clients.show', [$id]) }}" id="view-client-{{ $id }}"><i
                        class="fa fa-search"></i> @lang('bt.view')</a>
        <a class="dropdown-item" href="{{ route('clients.edit', [$id]) }}" id="edit-client-{{ $id }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a href ="javascript:void(0)" class="create-quote dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('bt.create_quote')</a>
        <a href ="javascript:void(0)" class="create-workorder dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('bt.create_workorder')</a>
        <a href ="javascript:void(0)" class="create-invoice dropdown-item" data-unique-name="{{ $unique_name }}"><i
                        class="far fa-file-alt"></i> @lang('bt.create_invoice')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('@lang('bt.trash_client_warning')', '@lang('bt.trash_client_warning_msg')', '{{ route('clients.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
