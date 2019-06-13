@extends('layouts.master')

@section('content')

    {!! Form::open(['route' => ['import.map.submit', $importType], 'class' => 'form-horizontal']) !!}

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.map_fields_to_import')
        </h3>

        <div class="float-right">
            {!! Form::submit(trans('bt.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tbody>
                    @foreach ($importFields as $key => $field)
                        <tr>
                            <td style="width: 20%;">{{ $field }}</td>
                            <td>{!! Form::select($key, $fileFields, (is_numeric(array_search($key, $fileFields)) ? array_search($key, $fileFields) : null), ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
