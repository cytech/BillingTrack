
@include('workorders.partials._js_create')

<div class="modal fade" id="create-workorder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.create_workorder')</h4>
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
                        <label class="col-sm-4 text-right">@lang('bt.date')</label>
                        <div class="col-sm-8">
                            {!! Form::text('workorder_date', date(config('bt.dateFormat')), ['id' => 'create_workorder_date', 'class' => 'form-control']) !!}
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
                            {!! Form::select('group_id', $groups, config('bt.workorderGroup'), ['id' => 'create_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="workorder-create-confirm"
                        class="btn btn-primary">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
