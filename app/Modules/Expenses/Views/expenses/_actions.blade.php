<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        @if ($model->is_billable and !$model->has_been_billed)
            <li><a href="javascript:void(0)" class="btn-bill-expense" data-expense-id="{{ $id }}"><i class="fa fa-money"></i> {{ trans('fi.bill_this_expense') }}</a></li>
        @endif
        <li><a href="{{ route('expenses.edit', [$id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('expenses.delete', [$id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
    </ul>
</div>