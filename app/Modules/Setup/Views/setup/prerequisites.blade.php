@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.prerequisites')</h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        <p>@lang('bt.step_prerequisites')</p>

                        <ul>
                            @foreach ($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <a href="{{ route('setup.prerequisites') }}" class="btn btn-primary">@lang('bt.try_again')</a>

                    </div>

                </div>

            </div>

        </div>

        {!! Form::close() !!}

    </section>

@stop
