{!! Html::style('plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
{!! Html::script('plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

<div id="create-workorder" style="display: none">
    {!! Form::open(['route' => 'api.createwo','id' => 'create-workorderform']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
    <div class="form-group d-flex align-items-center">
        <label for="company_profile_id" class="col-sm-4 text-right text">@lang('fi.company_profile')</label>
        <div class="col-sm-8">
            {!! Form::select('company_profile_id', $companyProfiles, config('fi.defaultCompanyProfile'),
            ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group d-flex align-items-center">
        <label for="client_name" class="col-sm-4 text-right text">@lang('fi.customer')</label>
        <div class="col-sm-8">
            <input type="text" id="client_name" name="client_name" class="form-control"
                   placeholder="Enter Customer Name" minlength="3" required>
        </div>
    </div>
    <div class="form-group d-flex align-items-center">
        <label for="summary" class="col-sm-4 text-right text">@lang('fi.job_summary')</label>
        <div class="col-sm-8">
            <input type="text" id="summary" name="summary" class="form-control"
                   placeholder="Enter Job Summary - (500 characters max)"
                   value="" minlength="3" required>
        </div>
    </div>
    <input type="hidden" id="workorder_date" name="workorder_date" value="{!! date('Y-m-d') !!}">
    <input type="hidden" id="job_date" name="job_date" value="" class="form-control" readonly>
    <div class="form-group d-flex align-items-center">
        <label for="start_time"
               class="col-sm-2 text-right text">@lang('fi.start_time')</label>
        <div class="col-sm-2">
            <input type="text" id="start_time" required name="start_time"
                   class="form-control datepicker start_time readonly"
                   placeholder="Start Time" autocomplete="off">
        </div>
        <label for="end_time" class="col-sm-2 text-right text">@lang('fi.end_time')</label>
        <div class="col-sm-2">
            <input type="text" id="end_time" required name="end_time" class="form-control datepicker end_time readonly"
                   placeholder="End Time" autocomplete="off">
        </div>
        <label for="will_call" class="col-sm-2 text-right text"> @lang('fi.will_call')</label>
        <div class="col-sm-2">
            {!! Form::checkbox('will_call', 1, null, ['id' => 'will_call', 'class' => 'checkbox']) !!}
        </div>

        <script>
            $.fn.bootstrapSwitch.defaults.size = 'small';
            $.fn.bootstrapSwitch.defaults.onText = 'Yes';
            $.fn.bootstrapSwitch.defaults.offText = 'No';
            $.fn.bootstrapSwitch.defaults.onColor = 'success';
            $.fn.bootstrapSwitch.defaults.offColor = 'danger';
            $("[name='will_call']").bootstrapSwitch();
        </script>
    </div>
    <div class="row">
        <div class="col-5 ml-5">
            <br>
            <b>@lang('fi.available_employees')</b><br>
            @lang('fi.select_workers_toworkorder')<br>
            <div id="ScrollCB1" style="height:200px;width:250px;overflow:auto">
                <div id="wtable">
                    {{--script to get selected worker checkboxes,format as uri, and open new BillingTrack workorder--}}
                    <script>
                        wstr = '';
                        $('#create-workorder').on('click', '[id*=worker]', function () {
                            counter = 0;
                            const wsel = $('#worker:checked').map(function (_, el) {
                                counter++;
                                return "worker" + counter + "/" + $(el).val();
                            }).get();

                            wstr = wsel.join("/");
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-6 ml-1">
            <br>
            <b>@lang('fi.available_equip')</b><br>
            @lang('fi.select_items_toworkorder')
            <div id="ScrollCB2" style="height:200px;width:350px;overflow:auto">
                <div style='margin-left:auto;margin-right:auto' id="rtable">
                    <script>
                        rstr = '';
                        $('#create-workorder').on('click', '[id*=resource]', function () {
                            if ($(this).is(":checked"))
                                $("#quantity" + $(this).val()).removeAttr("disabled");
                            else
                                $("#quantity" + $(this).val()).attr("disabled", "disabled");
                            counter = 0;
                            const rsel = $('#resource:checked').map(function (_, el) {
                                counter++;
                                return "resource" + counter + "/" + $(el).val();
                            }).get();

                            rstr = rsel.join("/");

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
