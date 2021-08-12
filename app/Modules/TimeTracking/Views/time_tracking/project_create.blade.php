@extends('layouts.master')

@section('javaScript')
    {{--@include('layouts._typeahead')--}}
    {{--@include('clients._js_lookup')--}}

@stop

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    {!! Form::open(['route' => 'timeTracking.projects.store']) !!}

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.create_project')
        </h3>
        <div class="float-right">
            <a class="btn btn-warning float-right" href={!! route('timeTracking.projects.index')  !!}><i
                        class="fa fa-ban"></i> @lang('bt.cancel')</a>
            <button class="btn btn-primary"><i class="fa fa-save"></i> @lang('bt.save')</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-md-12">

                <div class="card card-light">

                    <div class="card-body">

                        <div class="form-group">
                            <label>* @lang('bt.project_name'): </label>
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>* @lang('bt.company_profile'):</label>
                                {!! Form::select('company_profile_id', $companyProfiles, config('bt.defaultCompanyProfile'),
                                ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>* @lang('bt.client'):</label>
                                {!! Form::text('client_name', null, ['id' => 'client_name', 'class' =>
                                'form-control client-lookup', 'autocomplete' => 'off']) !!}
                                <script>
                                    $('.client-lookup').autocomplete({
                                        source: '{{ route('clients.ajax.lookup') }}',
                                        minLength: 3
                                    }).autocomplete("widget");
                                </script>
                            </div>
                            <div class="col-md-4">
                                <label>* @lang('bt.due_date'):</label>
                                {!! Form::text('due_at', null, ['id' => 'due_at', 'class' => 'date-picker form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>* @lang('bt.hourly_rate'):</label>
                                {!! Form::text('hourly_rate', null, ['id' => 'hourly_rate', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {!! Form::close() !!}

    <script type="text/javascript">
        $(function () {
            $("#due_at").datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});
        })
    </script>

@stop
