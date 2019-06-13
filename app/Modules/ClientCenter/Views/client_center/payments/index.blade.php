@extends('client_center.layouts.logged_in')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.payments')</h1>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-12">

                <div class=" card card-light">

                    <div class="card-body">
                        @include('client_center.payments._table')
                    </div>

                </div>

                <div class="float-right">
                    {!! $payments->render() !!}
                </div>

            </div>

        </div>

    </section>

@stop
