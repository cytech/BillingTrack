@include('partials._js_replace_employee')

<div class="modal fade" id="replace-employee">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.replace_employee')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                    <input type="hidden" name="item_id" value="{{ $item_id }}" id="item_id">

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{--{!! Form::text('client_name', null, ['id' => 'create_client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off']) !!}--}}
                            <label>@lang('bt.replace_modal_desc', ['short_name' => $inactive_employee->short_name])</label>
                        </div>
                    </div>

                    {!! Form::select('aemployee', $available_employees, null, ['id' => 'aemployee','placeholder' => 'Select Available Employee','class'=>'form-control']) !!}

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="replace-employee-confirm"
                        class="btn btn-primary">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
