<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        @if ($model->is_billable and !$model->has_been_billed)
            <a class="dropdown-item btn-bill-expense" href ="javascript:void(0)" data-expense-id="{{ $id }}"><i class="fa fa-dollar-sign"></i> @lang('bt.bill_this_expense')</a>
        @endif
        <a class="dropdown-item" href ="{{ route('expenses.edit', [$id]) }}"><i class="fa fa-edit"></i> @lang('bt.edit')</a>
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('expenses.delete', [$id]) }}');"><i class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
