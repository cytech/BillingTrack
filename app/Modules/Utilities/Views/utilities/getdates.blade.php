@extends('layouts.master')

@section('javascript')
    @include('layouts._daterangepicker')
@stop

@section('content')
    @include('layouts._alerts')

    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('fi.getdates') }}
                </h3>
            </div>
            <div class="panel-body">
                <div class="modal-body">
                    <div id="modal-status-placeholder"></div>
                        {!! Form::open(['route' => 'utilities.batchprint', 'class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        <label>Select Entity Type for BatchPrint</label>
                        {!! Form::select('batch_type',['quotes' => 'Quotes', 'workorders' => 'Workorders', 'invoices' => 'Invoices'],
                                        'workorders', ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        <span class="help-block">Criteria:<br>Quotes- sent or approved, not converted to workorder or invoice<br>
                        Workorders - sent or approved, not converted to invoice<br>
                        Invoices - sent (not paid)<br>
                        Note: If there are a large number of documents in the daterange, this will take a long time to generate the PDF</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.date_range') }}:</label>
                        {!! Form::hidden('from_date', null, ['id' => 'from_date']) !!}
                        {!! Form::hidden('to_date', null, ['id' => 'to_date']) !!}
                        {!! Form::text('date_range', null, ['id' => 'date_range', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    <script>
                        $('#from_date').val(moment());
                        $('#to_date').val(moment());
                    </script>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <div class="col-md-12 text-center">
                <a class="btn btn-warning btn-lg" href={!! route('workorders.dashboard')  !!}>{{ trans('fi.cancel') }} <span
                            class="glyphicon glyphicon-remove-circle"></span></a>
                <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.process') }} <span
                            class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
