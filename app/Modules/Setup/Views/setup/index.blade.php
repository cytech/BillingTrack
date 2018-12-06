@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>@lang('fi.license_agreement')</h1>
    </section>

    <section class="content">

        {!! Form::open() !!}

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        <div class="form-group">
                            {!! Form::textarea('', $license, ['id' => 'license', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::checkbox('accept', 1) !!} @lang('fi.license_agreement_accept')
                        </div>

                        {!! Form::submit(trans('fi.i_accept'), ['class' => 'btn btn-primary']) !!}

                    </div>

                </div>

            </div>

        </div>

        {!! Form::close() !!}

    </section>

@stop