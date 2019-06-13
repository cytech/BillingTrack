@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#password').focus();
        });
    </script>

    {!! Form::open(['route' => ['users.password.update', $user->id]]) !!}

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.reset_password'): {{ $user->name }} ({{ $user->email }})
        </h3>
        <a class="btn btn-warning float-right" href={!! route('users.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-user-lock"></i> @lang('bt.reset_password') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>@lang('bt.password'): </label>
                    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>@lang('bt.password_confirmation'): </label>
                    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
