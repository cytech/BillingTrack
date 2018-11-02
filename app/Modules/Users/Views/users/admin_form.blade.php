@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();

            $('#btn-generate-api-keys').click(function () {
                $.post("{{ route('api.generateKeys') }}", function (response) {
                    $('#api_public_key').val(response.api_public_key);
                    $('#api_secret_key').val(response.api_secret_key);
                });
            });

            $('#btn-clear-api-keys').click(function () {
                $('#api_public_key').val('');
                $('#api_secret_key').val('');
            })
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($user, ['route' => ['users.update', $user->id, 'admin']]) !!}
    @else
        {!! Form::open(['route' => ['users.store', 'admin']]) !!}
    @endif

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.admin') . ' ' . trans('fi.user_form') }}
        </h3>
        <a class="btn btn-warning float-right" href={!! route('users.index')  !!}><i
                    class="fa fa-ban"></i> {{ trans('fi.cancel') }}</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> {{ trans('fi.save') }} </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class=" card card-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.name') }}: </label>
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('fi.email') }}: </label>
                            {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                @if (!$editMode)
                    <div class="form-group">
                        <label>{{ trans('fi.password') }}: </label>
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.password_confirmation') }}: </label>
                        {!! Form::password('password_confirmation', ['id' => 'password_confirmation',
                        'class' => 'form-control']) !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.api_public_key') }}: </label>
                            {!! Form::text('api_public_key', null, ['id' => 'api_public_key', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('fi.api_secret_key') }}: </label>
                            {!! Form::text('api_secret_key', null, ['id' => 'api_secret_key', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-secondary" id="btn-generate-api-keys">{{ trans('fi.generate_keys') }}</a>
                <a href="#" class="btn btn-secondary" id="btn-clear-api-keys">{{ trans('fi.clear_keys') }}</a>
            </div>
        </div>

        @if ($customFields->count())
            <div class=" card card-light">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('fi.custom_fields') }}</h3>
                </div>
                <div class="card-body">
                    @include('custom_fields._custom_fields')
                </div>
            </div>
        @endif
    </section>

    {!! Form::close() !!}
@stop