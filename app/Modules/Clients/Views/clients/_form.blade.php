@include('clients._js_unique_name')

<script type="text/javascript">
    $(function() {
        $('#name').focus();
    });
</script>

<div class="row">
    <div class="col-md-4" id="col-client-name">
        <div class="form-group">
            <label>* @lang('fi.client_name'):</label>
            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
            <p class="form-text text-muted">
                <small>@lang('fi.help_text_client_name')
                    <a href="javascript:void(0)" id="btn-show-unique-name"
                       tabindex="-1">@lang('fi.view_unique_name')</a>
                </small>
            </p>
        </div>
    </div>
    <div class="col-md-3" id="col-client-unique-name" style="display: none;">
        <div class="form-group">
            <label>* @lang('fi.unique_name'):</label>
            {!! Form::text('unique_name', null, ['id' => 'unique_name', 'class' => 'form-control']) !!}
            <p class="form-text text-muted">
                <small>@lang('fi.help_text_client_unique_name')</small>
            </p>
        </div>
    </div>
    <div class="col-md-4" id="col-client-email">
        <div class="form-group">
            <label>@lang('fi.email_address'): </label>
            {!! Form::text('client_email', null, ['id' => 'client_email', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4" id="col-client-active">
        <div class="form-group">
            <label>@lang('fi.active'):</label>
            {!! Form::select('active', ['0' => trans('fi.no'), '1' => trans('fi.yes')], ((isset($editMode) and $editMode) ? null : 1), ['id' => 'active', 'class' => 'form-control']) !!}
        </div>
    </div>
</div>
<ul class="nav nav-tabs p-2">
    <li class="nav-item"><a class="nav-link active show" href="#tab-address"
                            data-toggle="tab">@lang('fi.billing_address')</a></li>
        <li class="nav-item"><a class="nav-link" href="#tab-address_2"
                                data-toggle="tab">@lang('fi.shipping_address')</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab-address">
    <label>@lang('fi.billing_address'): </label>
    {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control mb-3', 'rows' => 2]) !!}
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.city'): </label>
                    {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.state'): </label>
                    {!! Form::text('state', null, ['id' => 'state', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.postal_code'): </label>
                    {!! Form::text('zip', null, ['id' => 'zip', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.country'): </label>
                    {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane " id="tab-address_2">
        <label>@lang('fi.shipping_address'): </label>
        {!! Form::textarea('address_2', null, ['id' => 'address_2', 'class' => 'form-control mb-3', 'rows' => 2]) !!}

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.city'): </label>
                    {!! Form::text('city_2', null, ['id' => 'city_2', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.state'): </label>
                    {!! Form::text('state_2', null, ['id' => 'state_2', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.postal_code'): </label>
                    {!! Form::text('zip_2', null, ['id' => 'zip_2', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('fi.country'): </label>
                    {!! Form::text('country_2', null, ['id' => 'country_2', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.phone_number'): </label>
            {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.fax_number'): </label>
            {!! Form::text('fax', null, ['id' => 'fax', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.mobile_number'): </label>
            {!! Form::text('mobile', null, ['id' => 'mobile', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.web_address'): </label>
            {!! Form::text('web', null, ['id' => 'web', 'class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.default_currency'): </label>
            {!! Form::select('currency_code', $currencies, ((isset($client)) ? $client->currency_code : config('fi.baseCurrency')), ['id' => 'currency_code', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.language'): </label>
            {!! Form::select('language', $languages, ((isset($client)) ? $client->language : config('fi.language')), ['id' => 'language', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.industry'): </label>
            {!! Form::select('industry_id', $industries, null, ['id' => 'industry_id', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.size'): </label>
            {!! Form::select('size_id', $sizes, null , ['id' => 'size_id', 'class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.id_number'): </label>
            {!! Form::text('id_number', null, ['id' => 'id_number', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('fi.vat_number'): </label>
            {!! Form::text('vat_number', null, ['id' => 'vat_number', 'class' => 'form-control']) !!}
        </div>
    </div>
</div>

@if ($customFields->count())
    @include('custom_fields._custom_fields')
@endif
