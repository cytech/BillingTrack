@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.account_setup')</h1>
    </section>

    <section class="content">

        {!! Form::open(['route' => 'setup.postAccount', 'class' => 'form-install']) !!}

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        @include('layouts._alerts')

                        <h4>@lang('bt.user_account')</h4>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                {!! Form::text('user[name]', null, ['class' => 'form-control', 'placeholder' => '* '.trans('bt.name'), 'required']) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::text('user[email]', null, ['class' => 'form-control', 'placeholder' => '* '.trans('bt.email'), 'required']) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::password('user[password]', ['class' => 'form-control', 'placeholder' => '* '.trans('bt.password'), 'required']) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::password('user[password_confirmation]', ['class' => 'form-control', 'placeholder' => '* '.trans('bt.password_confirmation'), 'required']) !!}
                            </div>

                        </div>

                        <h4>@lang('bt.company_profile')</h4>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                {!! Form::text('company_profile[company]', null, ['class' => 'form-control', 'placeholder' => '* '.trans('bt.company'), 'required']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                {!! Form::textarea('company_profile[address]', null, ['class' => 'form-control', 'placeholder' => trans('bt.address'), 'rows' => 4]) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::text('company_profile[city]', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => trans('bt.city')]) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::text('company_profile[state]', null, ['id' => 'state', 'class' => 'form-control', 'placeholder' => trans('bt.state')]) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::text('company_profile[zip]', null, ['id' => 'zip', 'class' => 'form-control', 'placeholder' => trans('bt.postal_code')]) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::text('company_profile[country]', null, ['id' => 'country', 'class' => 'form-control', 'placeholder' => trans('bt.country')]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                {!! Form::text('company_profile[phone]', null, ['class' => 'form-control', 'placeholder' => trans('bt.phone')]) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::text('company_profile[mobile]', null, ['class' => 'form-control', 'placeholder' => trans('bt.mobile')]) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::text('company_profile[fax]', null, ['class' => 'form-control', 'placeholder' => trans('bt.fax')]) !!}
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::text('company_profile[web]', null, ['class' => 'form-control', 'placeholder' => trans('bt.web')]) !!}
                            </div>

                        </div>

                        <button class="btn btn-primary" type="submit">@lang('bt.continue')</button>

                    </div>

                </div>

            </div>

        </div>

        {!! Form::close() !!}

    </section>

@stop
