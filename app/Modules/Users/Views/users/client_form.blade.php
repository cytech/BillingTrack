@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {

            $('#client_id').change(function () {
                $.post('{{ route('users.clientInfo') }}', {
                    id: $('#client_id').val()
                }).done(function (response) {
                    $('#name').val(response.unique_name);
                    $('#email').val(response.email);
                });
            });

        });
    </script>

    @if ($editMode == true)
        {!! Form::model($user, ['route' => ['users.update', $user->id, 'client']]) !!}
    @else
        {!! Form::open(['route' => ['users.store', 'client']]) !!}
    @endif

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.client') @lang('bt.user_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('users.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class=" card card-light">
            <div class="card-body">
                @if (!$editMode)
                    <div class="form-group">
                        <label>@lang('bt.client'):</label>
                        {!! Form::select('client_id', ['' => ''] + $clients, null, ['class' => 'form-control', 'id' => 'client_id']) !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('bt.name'): </label>
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('bt.email'): </label>
                            {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                </div>
                @if (!$editMode)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('bt.password'): </label>
                                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('bt.password_confirmation'): </label>
                                {!! Form::password('password_confirmation', ['id' => 'password_confirmation',
                                'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if ($customFields->count())
            <div class=" card card-light">
                <div class="box-header">
                    <h3 class="box-title">@lang('bt.custom_fields')</h3>
                </div>
                <div class="card-body">
                    @include('custom_fields._custom_fields')
                </div>
            </div>
        @endif
    </section>

    {!! Form::close() !!}
@stop
