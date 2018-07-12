@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>{{ trans('fi.newaccount_or_transfer') }}</h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-body">

                        <a href="{{ route('setup.newaccount') }}" class="btn btn-primary" id="btn-run-newaccount">{{ trans('fi.new_account') }}</a>
                        <br><br><br>
                        <a href="{{ route('setup.xferaccount') }}" class="btn btn-primary" id="btn-run-xferaccount">{{ trans('fi.transfer_existing') }}</a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@stop