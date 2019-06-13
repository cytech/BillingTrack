
{{--@include('layouts._typeahead')--}}
@include('clients._js_lookup')
@include('recurring_invoices._js_create')

<div class="modal fade" id="create-recurring-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.create_recurring_invoice')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>
                <form>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">@lang('bt.client')</label>
                        <div class="col-sm-8">
                            {!! Form::text('client_name', null, ['id' => 'create_client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('bt.company_profile')</label>

                        <div class="col-sm-8">
                            {!! Form::select('company_profile_id', $companyProfiles, config('bt.defaultCompanyProfile'),
                            ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('bt.group')</label>

                        <div class="col-sm-8">
                            {!! Form::select('group_id', $groups, config('bt.invoiceGroup'), ['id' => 'create_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('bt.start_date')</label>
                        <div class="col-sm-8">
                            {!! Form::text('next_date', date(config('bt.dateFormat')), ['id' => 'create_next_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('bt.every')</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-3">
                                    {!! Form::select('recurring_frequency', array_combine(range(1, 90), range(1, 90)), '1', ['id' => 'recurring_frequency', 'class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-9">
                                    {!! Form::select('recurring_period', $frequencies, 3, ['id' => 'recurring_period', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">@lang('bt.stop_date')</label>
                        <div class="col-sm-8">
                            {!! Form::text('stop_date', null, ['id' => 'create_stop_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="recurring-invoice-create-confirm" class="btn btn-primary">@lang('bt.submit')
                </button>
            </div>
        </div>
    </div>
</div>
