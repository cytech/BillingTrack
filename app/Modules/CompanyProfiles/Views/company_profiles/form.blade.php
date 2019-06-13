@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();

            @if ($editMode == true)
            $('#btn-delete-logo').click(function () {
                $.post("{{ route('companyProfiles.deleteLogo', [$companyProfile->id]) }}").done(function () {
                    $('#div-logo').html('');
                });
            });
            @endif
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($companyProfile, ['route' => ['companyProfiles.update', $companyProfile->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'companyProfiles.store', 'files' => true]) !!}
    @endif

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.company_profile_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('companyProfiles.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>@lang('bt.company'): </label>
                    {!! Form::text('company', null, ['id' => 'company', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>@lang('bt.address'): </label>
                    {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control', 'rows' => 4]) !!}
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.phone'): </label>
                            {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.fax'): </label>
                            {!! Form::text('fax', null, ['id' => 'fax', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.mobile'): </label>
                            {!! Form::text('mobile', null, ['id' => 'mobile', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.web'): </label>
                            {!! Form::text('web', null, ['id' => 'web', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.logo'): </label>
                            @if (!config('app.demo'))
                                <div id="div-logo">
                                    @if ($editMode and $companyProfile->logo)
                                        <p>{!! $companyProfile->logo(100) !!}</p>
                                        <a href="javascript:void(0)"
                                           id="btn-delete-logo">@lang('bt.remove_logo')</a>
                                    @endif
                                </div>
                                {!! Form::file('logo') !!}
                            @else
                                Disabled for demo
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.default_quote_template'):</label>
                            {!! Form::select('quote_template', $quoteTemplates, ((isset($companyProfile)) ? $companyProfile->quote_template : config('bt.quoteTemplate')), ['id' => 'invoice_template', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.default_workorder_template'):</label>
                            {!! Form::select('workorder_template', $workorderTemplates, ((isset($companyProfile)) ? $companyProfile->workorder_template : config('bt.workorderTemplate')), ['id' => 'invoice_template', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.default_invoice_template'):</label>
                            {!! Form::select('invoice_template', $invoiceTemplates, ((isset($companyProfile)) ? $companyProfile->invoice_template : config('bt.invoiceTemplate')), ['id' => 'invoice_template', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>
                @if ($customFields->count())
                    @include('custom_fields._custom_fields')
                @endif
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
