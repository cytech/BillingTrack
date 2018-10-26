<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        {{ trans('fi.options') }} <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('quotes.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
        <a class="dropdown-item" href ="{{ route('quotes.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-quote"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a>
        <a class="dropdown-item" href ="javascript:void(0)" class="email-quote" data-quote-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> {{ trans('fi.email') }}</a>
        <a class="dropdown-item" href ="{{ route('clientCenter.public.quote.show', [$url_key]) }}"
               target="_blank" id="btn-public-quote"><i
                        class="fa fa-globe"></i> {{ trans('fi.public') }}</a>
        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('quotes.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
    </div>
</div>