<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('recurringInvoices.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}' ,'{{ route('recurringInvoices.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
    </div>
</div>
