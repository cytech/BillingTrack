<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href ="{{ route('quotes.edit', [$id]) }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a class="dropdown-item" href ="{{ route('quotes.pdf', [$id]) }}" target="_blank"
               id="btn-pdf-quote"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        @if (config('bt.mailConfigured'))
        <a class="dropdown-item email-quote" href ="javascript:void(0)" data-quote-id="{{ $id }}"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-envelope"></i> @lang('bt.email')</a>
        @endif
        <a class="dropdown-item" href ="{{ route('clientCenter.public.quote.show', [$url_key]) }}"
               target="_blank" id="btn-public-quote"><i
                        class="fa fa-globe"></i> @lang('bt.public')</a>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href ="#"
               onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('quotes.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
    </div>
</div>
