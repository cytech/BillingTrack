<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('workorders.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a class="dropdown-item" href ="{{ route('workorders.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-workorder"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        {{--<a class="dropdown-item email-workorder" href ="javascript:void(0)" data-workorder-id="{{ $id }}"--}}
               {{--data-redirect-to="{{ request()->fullUrl() }}"><i--}}
                        {{--class="fa fa-envelope"></i> @lang('bt.email')</a>--}}
        <a class="dropdown-item" href ="{{ route('clientCenter.public.workorder.show', [$url_key]) }}"
               target="_blank" id="btn-public-workorder"><i
                        class="fa fa-globe"></i> @lang('bt.public')</a>
        <div class="dropdown-divider"></div>
        @if($model->quote)
            <a class="dropdown-item" href="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')','@lang('bt.trash_workorder_warning_assoc_msg')', '{{ route('workorders.delete', [$model->id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
        @else
            <a class="dropdown-item" href="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('workorders.delete', [$model->id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
        @endif
    </div>
</div>
