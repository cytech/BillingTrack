<script type="text/javascript">
    $(function () {
        $('#name').focus();
    });
</script>
<div class="container col-md-12">
    <div class="card-group">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('bt.vendor')</h4>
            </div>
            <div class="card-body">
                <div class="row col-md-12  " id="col-vendor-name">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">* @lang('bt.vendor_name'): </label>
                    </div>
                    <div class="col-md-8 mb-1">
                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1" id="col-vendor-email">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.email_address'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('vendor_email', null, ['id' => 'vendor_email', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.phone_number'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.fax_number'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('fax', null, ['id' => 'fax', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.mobile_number'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('mobile', null, ['id' => 'mobile', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.web_address'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('web', null, ['id' => 'web', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.id_number'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('id_number', null, ['id' => 'id_number', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12 mb-1">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.vat_number'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('vat_number', null, ['id' => 'vat_number', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row col-md-12" id="col-vendor-active">
                    <div class="col-md-4 text-right">
                        <label class="col-form-label">@lang('bt.active'): </label>
                    </div>
                    <div class="col-md-8">
                        {!! Form::select('active', ['0' => trans('bt.no'), '1' => trans('bt.yes')], ((isset($editMode) and $editMode) ? null : 1), ['id' => 'active', 'class' => 'form-control']) !!}
                    </div>
                </div>


            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('bt.address')</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs p-2">
                    <li class="nav-item"><a class="nav-link active show" href="#tab-address"
                                            data-toggle="tab">@lang('bt.billing_address')</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-address_2"
                                            data-toggle="tab">@lang('bt.shipping_address')</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-address">
                        <div class="row col-md-12 mt-3">
                            <label>@lang('bt.billing_address'): </label>
                            {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control mb-3', 'rows' => 2]) !!}
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.city'): </label>
                                    {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.state'): </label>
                                    {!! Form::text('state', null, ['id' => 'state', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.postal_code'): </label>
                                    {!! Form::text('zip', null, ['id' => 'zip', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.country'): </label>
                                    {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-address_2">
                        <div class="row col-md-12 mt-3">
                            <div class="col-md-6 text-right">
                                {{ Form::label('fill_shipping', __('bt.copy_billing')) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::checkbox('fill_shipping', 1 , null ) }}
                                {{-- see script --}}
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <label>@lang('bt.shipping_address'): </label>
                            {!! Form::textarea('address_2', null, ['id' => 'address_2', 'class' => 'form-control mb-3', 'rows' => 2]) !!}
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.city'): </label>
                                    {!! Form::text('city_2', null, ['id' => 'city_2', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.state'): </label>
                                    {!! Form::text('state_2', null, ['id' => 'state_2', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.postal_code'): </label>
                                    {!! Form::text('zip_2', null, ['id' => 'zip_2', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('bt.country'): </label>
                                    {!! Form::text('country_2', null, ['id' => 'country_2', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <script>
                        //Bootstrap Switch-button
                        document.getElementById('fill_shipping').switchButton({
                            onlabel: '@lang('bt.yes')',
                            offlabel: '@lang('bt.no')',
                            onstyle: 'success',
                            offstyle: 'danger',
                            size: 'sm'
                        });
                        $('#fill_shipping').change(function() {
                            if ($(this).prop('checked')) {
                                $('#address_2').val($('#address').val());
                                $('#city_2').val($('#city').val());
                                $('#state_2').val($('#state').val());
                                $('#zip_2').val($('#zip').val());
                                $('#country_2').val($('#country').val());
                            } else {
                                $('#address_2').val('');
                                $('#city_2').val('');
                                $('#state_2').val('');
                                $('#zip_2').val('');
                                $('#country_2').val('');
                            }
                        })
                    </script>

                </div>
            </div>
        </div>
    </div>
    <div class="card-group">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('bt.other')</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('bt.default_currency'): </label>
                            {!! Form::select('currency_code', $currencies, ((isset($vendor)) ? $vendor->currency_code : config('bt.baseCurrency')), ['id' => 'currency_code', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('bt.language'): </label>
                            {!! Form::select('language', $languages, ((isset($vendor)) ? $vendor->language : config('bt.language')), ['id' => 'language', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('bt.payment_terms'): </label>
                            {!! Form::select('paymentterm_id', $payment_terms, null, ['id' => 'paymentterm_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($customFields->count())
        @include('custom_fields._custom_fields')
    @endif

</div>
