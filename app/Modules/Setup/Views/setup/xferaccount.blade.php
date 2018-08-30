@extends('setup.master')

@section('content')

    <section class="content-header">
        <h1>Transfer Existing FusionInvoice 2018-8 database/schema</h1>
    </section>
@include('layouts._alerts')
    <section class="content">
        {!! Form::open() !!}
        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-body">
                        This should only be used on initial setup. It will clear the new database defaults
                        and any data added since creation, and replace with all data of the database entered below.
                        The result is all old database data transferred to new database format.
                        <br><br>
                        Note: This process may take a long time with no feedback, be patient.
                        i.e. an existing database of 30 MiB takes about 10 minutes.
                        <br><br>
                        The name entered below must EXACTLY match the name on the database server.
                        <br><br><br>
                        {!! Form::text('olddbname') !!}
                        <br><br><br>
                        {!! Form::submit(trans('fi.continue'), ['class' => 'btn btn-primary']) !!}
                    </div>

                </div>

            </div>

        </div>
        {!! Form::close() !!}
    </section>

@stop