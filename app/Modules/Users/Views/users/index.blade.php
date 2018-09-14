@extends('layouts.master')

@section('javascript')
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
        <h1 class="pull-left">
            {{ trans('fi.users') }}
        </h1>

        <div class="pull-right">
            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}
                {!! Form::select('userType', $userTypes, request('userType'), ['class' => 'user_filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    {{ trans('fi.new') }} <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('users.create', ['admin']) }}">{{ trans('fi.admin_account') }}</a></li>
                    <li><a href="{{ route('users.create', ['client']) }}">{{ trans('fi.client_account') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body">

                        {!! $dataTable->table(['class' => 'table dt-responsive display', 'width' => '100%', 'cellspacing' => '0']) !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{--<link rel="stylesheet" href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">--}}
    {{--<script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="/vendor/datatables/buttons.server-side.js"></script>--}}
    {!! $dataTable->scripts() !!}
@endpush