<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.min.css') }}">
<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}" type="text/javascript"></script>

@include('payments._js_mail')

<div class="modal fade" id="modal-mail-payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.email_payment_receipt')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.to')</label>

                        <div class="col-sm-9">
                            {!! $contactDropdownTo !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.cc')</label>

                        <div class="col-sm-9">
                            {!! $contactDropdownCc !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.bcc')</label>

                        <div class="col-sm-9">
                            {!! $contactDropdownBcc !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.subject')</label>

                        <div class="col-sm-9">
                            {!! Form::text('subject', $subject, ['id' => 'subject', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.body')</label>

                        <div class="col-sm-9">
                            {!! Form::textarea('body', $body, ['id' => 'body', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.attach_pdf')</label>

                        <div class="col-sm-9">
                            {!! Form::checkbox('attach_pdf', 1, config('bt.attachPdf'), ['id' => 'attach_pdf']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="btn-submit-mail-payment" class="btn btn-primary" data-loading-text="@lang('bt.sending')...">@lang('bt.send')</button>
            </div>
        </div>
    </div>
</div>
