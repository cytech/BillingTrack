<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{ route('workorders.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
        <li><a href="{{ route('workorders.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-workorder"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a></li>
        <li><a href="javascript:void(0)" class="email-workorder" data-workorder-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> {{ trans('fi.email') }}</a></li>
        {{--<li><a href="{{ route('clientCenter.public.workorder.show', [$url_key]) }}"--}}
               {{--target="_blank" id="btn-public-workorder"><i--}}
                        {{--class="fa fa-globe"></i> {{ trans('fi.public') }}</a></li>--}}
        <li><a href="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('workorders.delete', [$id]) }}');"><i
                        class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
    </ul>
</div>