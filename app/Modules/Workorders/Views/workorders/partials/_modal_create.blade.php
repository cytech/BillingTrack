@include('layouts._datepicker')
@include('layouts._typeahead')
@include('clients._js_lookup')
@include('Workorders::workorders.partials._js_create')

<div class="modal fade" id="create-workorder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('Workorders::texts.create_workorder') }}</h4>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form class="form-horizontal">

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.client') }}</label>

                        <div class="col-sm-9">
                            {!! Form::text('client_name', null, ['id' => 'create_client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('Workorders::texts.workorder_date') }}</label>

                        <div class="col-sm-9">
                            {!! Form::text('workorder_date', date(config('fi.dateFormat')), ['id' => 'create_workorder_date', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.company_profile') }}</label>

                        <div class="col-sm-9">
                            {!! Form::select('company_profile_id', $companyProfiles, config('fi.defaultCompanyProfile'),
                            ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.group') }}</label>

                        <div class="col-sm-9">
                            {!! Form::select('group_id', $groups, config('workorder_settings.workorderGroup'), ['id' => 'create_group_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="workorder-create-confirm"
                        class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>