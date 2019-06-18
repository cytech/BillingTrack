{{--@include('layouts._typeahead')--}}

@include('vendors._js_lookup')
@include('vendors._js_subchange')

<div class="modal fade" id="modal-lookup-vendor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.change_vendor')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">@lang('bt.vendor')</label>

                        <div class="col-sm-9">
                            {!! Form::text('vendor_name', null, ['id' => 'change_vendor_name', 'class' =>
                            'form-control vendor-lookup', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> @lang('bt.cancel')</button>
                <button type="button" id="btn-submit-change-vendor" class="btn btn-primary"><i class="fa fa-save"></i> @lang('bt.save')
                </button>
            </div>
        </div>
    </div>
</div>
