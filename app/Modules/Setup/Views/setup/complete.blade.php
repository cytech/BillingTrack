@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.installation_complete')</h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        <p>@lang('bt.you_may_now_sign_in')</p>

                        <a href="{{ route('session.login') }}" class="btn btn-primary">@lang('bt.sign_in')</a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@stop
