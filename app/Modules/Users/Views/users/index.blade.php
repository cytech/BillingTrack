@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        $(function () {
            $('.user_filter_options').change(function () {
                $('form#filter').submit();
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.users')
        </h3>
        @if (!config('app.demo'))
        <div class="float-right">
            {{--fix for datatable--}}
            {{--<div class="btn-group">--}}
                {{--{!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}--}}
                {{--{!! Form::select('userType', $userTypes, request('userType'), ['class' => 'user_filter_options form-control ']) !!}--}}
                {{--{!! Form::close() !!}--}}
            {{--</div>--}}
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    @lang('bt.new')
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('users.create', ['admin']) }}">@lang('bt.admin_account')</a>
                    <a class="dropdown-item" href="{{ route('users.create', ['client']) }}">@lang('bt.client_account')</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class=" card card-light">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table dt-responsive display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>
    @else
        <br><br>
        User configuration is disabled in the demo.
    @endif
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
