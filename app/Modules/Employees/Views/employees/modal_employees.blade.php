@include('employees._js_modal_employees')

<div class="modal fade" id="modal-choose-items">
    <div class="modal-dialog mw-100">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.add_employee')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <table class="table table-bordered table-striped" id="employee-table">
                    <thead>
                    <tr class="empheader">
                        <th></th>
                        <th>@lang('bt.employee_number')</th>
                        <th>@lang('bt.employee_short_name')</th>
                        <th>@lang('bt.employee_billing_rate')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $employee)
{{--                    <tr class="emplist" data-vendor_id = "{!!  $employee->vendor_id !!}" data-purch_vendor_id = "{!!  $vendorId !!}">--}}
                    <tr>
                    <td><input type="checkbox" name="employee_ids[]" value="{!! $employee->id!!}"></td>
                        <td>{!!  $employee->number !!}</td>
                        <td>{!!  $employee->short_name !!}</td>
                        <td>{!!  $employee->billing_rate !!}</td>
                    </tr>
                    @endforeach
                    </tbody>

            </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="select-items-confirm"
                        class="btn btn-primary">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
