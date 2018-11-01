@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#password').focus();
        });
    </script>

    {!! Form::open(['route' => ['users.password.update', $user->id]]) !!}

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.reset_password') }}: {{ $user->name }} ({{ $user->email }})
        </h3>
        <div class="float-right">
            {!! Form::submit(trans('fi.reset_password'), ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('fi.password') }}: </label>
                    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>{{ trans('fi.password_confirmation') }}: </label>
                    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop