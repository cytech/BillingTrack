@include('company_profiles._js_subchange')

<div class="modal fade" id="modal-lookup-company-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.change_company_profile')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>

                    <div class="form-group">
                        <label class="col-sm-4 col-form-label">@lang('bt.company_profile')</label>
                        <div class="col-sm-8">
                            {!! Form::select('change_company_profile_id', $companyProfiles, null, ['id' => 'change_company_profile_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="btn-submit-change-company-profile" class="btn btn-primary">@lang('bt.save')
                </button>
            </div>
        </div>
    </div>
</div>
