@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>@lang('bt.newaccount_or_transfer')</h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        <a href="{{ route('setup.newaccount') }}" class="btn btn-primary" id="btn-run-newaccount">@lang('bt.new_account')</a>
                        <br><br><br>
                        <a href="{{ route('setup.xferaccount') }}" class="btn btn-primary" id="btn-run-xferaccount">@lang('bt.transfer_existing')</a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@stop
