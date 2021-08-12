@extends('layouts.master')

@section('javaScript')
    @include('layouts._daterangepicker')
@stop

@section('content')
    @include('layouts._alerts')

    <section class="content-header">
        {!! Form::open(['route' => 'utilities.batchprint', 'class'=>'form-horizontal']) !!}
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">
                    @lang('bt.criteria_batchprint')
                </h3>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.process') </button>
            </div>
            <div class="card-body">
                <div class="modal-body">
                    <div id="modal-status-placeholder"></div>

                    <div class="form-group">
                        <label>Select Entity Type for BatchPrint</label>
                        {!! Form::select('batch_type',['quotes' => 'Quotes', 'workorders' => 'Workorders', 'invoices' => 'Invoices'],
                                        'workorders', ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        <span class="form-text text-muted">Criteria:<br>Quotes- sent or approved, not converted to workorder or invoice<br>
                        Workorders - sent or approved, not converted to invoice<br>
                        Invoices - sent (not paid)<br>
                        Note: If there are a large number of documents in the daterange, this will take a long time to generate the PDF</span>
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.date_range'):</label>
                        {!! Form::hidden('from_date', null, ['id' => 'from_date']) !!}
                        {!! Form::hidden('to_date', null, ['id' => 'to_date']) !!}
                        {!! Form::text('date_range', null, ['id' => 'date_range', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    <script>
                        $('#from_date').val('{{ \Carbon\Carbon::now() }}');
                        $('#to_date').val('{{ \Carbon\Carbon::now()}}');
                    </script>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@stop
