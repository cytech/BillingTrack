<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('quotes.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <a class="dropdown-item" href ="{{ route('quotes.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-quote"><i class="fa fa-print"></i> @lang('fi.pdf')</a>
        <a class="dropdown-item email-quote" href ="javascript:void(0)" data-quote-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> @lang('fi.email')</a>
        <a class="dropdown-item" href ="{{ route('clientCenter.public.quote.show', [$url_key]) }}"
               target="_blank" id="btn-public-quote"><i
                        class="fa fa-globe"></i> @lang('fi.public')</a>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('fi.trash_record_warning')', '{{ route('quotes.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>