@include('layouts._datepicker')
@include('layouts._typeahead')
@include('clients._js_lookup')
@include('quotes._js_create')
<div class="modal fade" id="create-quote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('fi.create_quote') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div id="modal-status-placeholder"></div>
                <form>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right text">{{ trans('fi.client') }}</label>
                        <div class="col-sm-8">
                            {!! Form::text('client_name', null, ['id' => 'create_client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">{{ trans('fi.date') }}</label>
                        <div class="col-sm-8">
                            {!! Form::text('quote_date', date(config('fi.dateFormat')), ['id' => 'create_quote_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">{{ trans('fi.company_profile') }}</label>
                        <div class="col-sm-8">
                            {!! Form::select('company_profile_id', $companyProfiles, config('fi.defaultCompanyProfile'),
                            ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label class="col-sm-4 text-right">{{ trans('fi.group') }}</label>
                        <div class="col-sm-8">
                            {!! Form::select('group_id', $groups, config('fi.quoteGroup'), ['id' => 'create_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="quote-create-confirm"
                        class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>