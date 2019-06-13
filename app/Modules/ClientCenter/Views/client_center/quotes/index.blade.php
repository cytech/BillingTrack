@extends('client_center.layouts.logged_in')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.quotes')</h1>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-12">

                <div class=" card card-light">

                    <div class="card-body">
                        @include('client_center.quotes._table')
                    </div>

                </div>

                <div class="float-right">
                    {!! $quotes->render() !!}
                </div>

            </div>

        </div>

    </section>

@stop
