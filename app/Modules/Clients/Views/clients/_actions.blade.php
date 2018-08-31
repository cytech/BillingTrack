<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('clients.show', [$id]) }}" id="view-client-{{ $id }}"><i
                        class="fa fa-search"></i> {{ trans('fi.view') }}</a></li>
        <li><a href="{{ route('clients.edit', [$id]) }}" id="edit-client-{{ $id }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="javascript:void(0)" class="create-quote" data-unique-name="{{ $unique_name }}"><i
                        class="fa fa-file-text-o"></i> {{ trans('fi.create_quote') }}</a></li>
        <li><a href="javascript:void(0)" class="create-workorder" data-unique-name="{{ $unique_name }}"><i
                        class="fa fa-file-text-o"></i> {{ trans('fi.create_workorder') }}</a></li>
        <li><a href="javascript:void(0)" class="create-invoice" data-unique-name="{{ $unique_name }}"><i
                        class="fa fa-file-text"></i> {{ trans('fi.create_invoice') }}</a></li>
        <li><a href="#" id="delete-client-{{ $id }}"
               onclick="swalConfirm('{{ trans('fi.trash_client_warning') }}', '{{ route('clients.delete', [$id]) }}');"><i
                        class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
    </ul>
</div>
