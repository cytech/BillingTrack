@extends('layouts.master')

@section('content')
    @include('layouts._alerts')

    <section class="content-header">
        <h3 class="float-left">@lang('bt.database')</h3>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Database Backup</h3>
                        @if (!config('app.demo'))
                            <a href="{{ route('backup.database') }}" target="_blank"
                               class="btn btn-green">@lang('bt.download_database_backup')</a>
                        @else
                            <p>Database backup not available in demo.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Database entities to trash</h3>
                        @if (!config('app.demo'))
                            {!! Form::open(['route' => 'trashprior.database','method' => 'get', 'id' => 'tprior', 'class'=>"form-inline"]) !!}
                            {{--            quotes workorders invoices payments purchaseorders schedule--}}
                            <div class="col-md-6">
                                This will trash all of the selected module type and its children, prior to the selected date.<br>
                                <b>IT IS HIGHLY RECOMMENDED YOU BACKUP YOUR DATABASE PRIOR TO RUNNING CLEANUP!!</b></b><br>
                                Depending on the number of records/children in the time range, this may take awhile to complete.<br>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Trash Before Date</label>
                                {!! Form::text('trashprior_date', Carbon\Carbon::parse('first day of january')->subYears(2)->format('m/d/Y'),
                                 ['id' => 'trashprior_date', 'class' => 'form-control ']) !!}
                            </div>
                                <div class="col-md-2 form-group">
                                    <label>Module to trash </label>
                                    {!! Form::select('trashprior_module', ['Quote'=>'Quotes', 'Workorder'=>'Workorders',
                                     'Invoice'=>'Invoices', 'Purchaseorder'=>'Purchaseorders',
                                      'Schedule'=>'Schedule'], null, ['class' => 'form-control']) !!}
                                </div>
                            <button type="submit" class="btn btn-danger float-right"><i
                                        class="fa fa-trash"></i> @lang('bt.trash') </button>
                            {!! Form::close() !!}
                        @else
                            <p>Database trashprior not available in demo.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <h3>Current trash count</h3>
                <div class="col-md-12">
                    Trashed Quote count = {{$quotecount}}<br>
                    Trashed Workorder count = {{$workordercount}}<br>
                    Trashed Invoice count = {{$invoicecount}}<br>
                    Trashed Purchaseorder count = {{$purchaseordercount}}<br>
                    Trashed Schedule count = {{$schedulecount}}<br>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>PERMANENTLY DELETE Database entities from trash</h3>
                    @if (!config('app.demo'))
                            {!! Form::open(['route' => 'deleteprior.database','method' => 'get', 'id' => 'dprior', 'class'=>"form-inline"]) !!}
                            {{--            quotes workorders invoices payments purchaseorders schedule--}}
                            <div class="col-md-6">
                                This will <b>PERMANENTLY DELETE</b> all of the selected module (only trashed) type and its children, prior to the selected date.<br>
                                <b>IT IS HIGHLY RECOMMENDED YOU BACKUP YOUR DATABASE PRIOR TO RUNNING CLEANUP!!</b><br>
                                Depending on the number of records/children in the time range, this may take awhile to complete.<br>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>DELETE Before Date</label>
                                {!! Form::text('deleteprior_date', Carbon\Carbon::parse('first day of january')->subYears(2)->format('m/d/Y'),
                                 ['id' => 'deleteprior_date', 'class' => 'form-control form-control-sm']) !!}
                            </div>
                                <div class="col-md-2 form-group">
                                    <label>Trashed Module to DELETE </label>
                                    {!! Form::select('deleteprior_module', ['Quote'=>'Quotes', 'Workorder'=>'Workorders',
                                     'Invoice'=>'Invoices', 'Purchaseorder'=>'Purchaseorders',
                                      'Schedule'=>'Schedule'], null, ['class' => 'form-control']) !!}
                                </div>
                            <button type="submit" class="btn btn-danger float-right"><i
                                        class="fa fa-ban"></i> @lang('bt.delete') </button>
                            {!! Form::close() !!}
                        @else
                            <p>Database deleteprior not available in demo.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('javascript')
<script>
    $(function () {

        $("#trashprior_date").datetimepicker({
            format: '{{ config('bt.dateFormat') }}',
            defaultDate: new Date(new Date().getFullYear() - 2, 0, 1), timepicker: false, scrollInput: false
        });

        $("#deleteprior_date").datetimepicker({
            format: '{{ config('bt.dateFormat') }}',
            defaultDate: new Date(new Date().getFullYear() - 2, 0, 1), timepicker: false, scrollInput: false
        });
    });
</script>
@stop
