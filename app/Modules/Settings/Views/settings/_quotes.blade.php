<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_quote_template'): </label>
            {!! Form::select('setting[quoteTemplate]', $quoteTemplates, config('bt.quoteTemplate'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_group'): </label>
            {!! Form::select('setting[quoteGroup]', $groups, config('bt.quoteGroup'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.quotes_expire_after'): </label>
            {!! Form::text('setting[quotesExpireAfter]', config('bt.quotesExpireAfter'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.default_status_filter'): </label>
            {!! Form::select('setting[quoteStatusFilter]', $quoteStatuses, config('bt.quoteStatusFilter'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

<div class="form-group">
    <label>@lang('bt.convert_quote_when_approved'): </label>
    {!! Form::select('setting[convertQuoteWhenApproved]', $yesNoArray, config('bt.convertQuoteWhenApproved'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>@lang('bt.convert_quote_setting'): </label>
    {!! Form::select('setting[convertQuoteTerms]', $convertQuoteOptions, config('bt.convertQuoteTerms'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_terms'): </label>
    {!! Form::textarea('setting[quoteTerms]', config('bt.quoteTerms'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_footer'): </label>
    {!! Form::textarea('setting[quoteFooter]', config('bt.quoteFooter'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.if_quote_is_emailed_while_draft'): </label>
            {!! Form::select('setting[resetQuoteDateEmailDraft]', $quoteWhenDraftOptions, config('bt.resetQuoteDateEmailDraft'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('bt.recalculate_quotes'): </label><br>
            @if (!config('app.demo'))
            <button type="button" class="btn btn-secondary" id="btn-recalculate-quotes"
                    data-loading-text="@lang('bt.recalculating_wait')">@lang('bt.recalculate')</button>
            @else
                Recalculate is disabled in the demo.
            @endif
            <p class="form-text text-muted">@lang('bt.recalculate_help_text')</p>
        </div>
    </div>
</div>
