@extends('layouts.master')

@section('content')

    {!! Form::open(['route' => 'import.upload', 'files' => true]) !!}

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.import_data') }}
        </h3>
        <div class="float-right">
            @if (!config('app.demo'))
                {!! Form::submit(trans('fi.submit'), ['class' => 'btn btn-primary']) !!}
            @endif
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('fi.what_to_import') }}</label>
                    {!! Form::select('import_type', $importTypes, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>{{ trans('fi.select_file_to_import') }}</label>
                    @if (!config('app.demo'))
                        {!! Form::file('import_file') !!}
                    @else
                        Imports are disabled in the demo.
                    @endif
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop