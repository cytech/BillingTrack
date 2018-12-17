@extends('layouts.master')

@section('head')

    {{--@include('layouts._typeahead')--}}
    {{--@include('clients._js_lookup')--}}
    @include('expenses._js_vendor_lookup')
    @include('expenses._js_category_lookup')
@stop

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('#expense_date').datetimepicker({format: '{{ config('fi.dateFormat') }}', timepicker: false, scrollInput: false});
        });
    </script>
@stop

@section('content')

    @if ($editMode == true)
        {!! Form::model($expense, ['route' => ['expenses.update', $expense->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'expenses.store', 'files' => true]) !!}
    @endif

    {!! Form::hidden('user_id', auth()->user()->id) !!}

    <section class="content-header">
        <h3 class="float-left">
            @lang('fi.expense_form')
        </h3>
        <div class="float-right">
            <button class="btn btn-primary"><i class="fa fa-save"></i> @lang('fi.save')</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-md-12">

                <div class="card card-light">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* @lang('fi.company_profile'): </label>
                                    {!! Form::select('company_profile_id', $companyProfiles, (($editMode) ? $expense->company_profile_id : config('fi.defaultCompanyProfile')), ['id' => 'company_profile_id', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* @lang('fi.date'): </label>
                                    {!! Form::text('expense_date', (($editMode) ? $expense->formatted_expense_date : $currentDate), ['id' => 'expense_date', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* @lang('fi.category'): </label>
                                    {!! Form::text('category_name', null, ['id' => 'category_name', 'class' => 'form-control category-lookup']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>* @lang('fi.amount'): </label>
                                    {!! Form::text('amount', (($editMode) ? $expense->formatted_numeric_amount : null), ['id' => 'amount', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>@lang('fi.tax'): </label>
                                    {!! Form::text('tax', (($editMode) ? $expense->formatted_numeric_tax : null), ['id' => 'amount', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> @lang('fi.vendor'): </label>
                                    {!! Form::text('vendor_name', null, ['id' => 'vendor_name', 'class' => 'form-control vendor-lookup']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> @lang('fi.client'): </label>
                                    {!! Form::text('client_name', null, ['id' => 'client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off']) !!}
                                </div>
                                <script>
                                    $('.client-lookup').autocomplete({
                                        source: '{{ route('clients.ajax.lookup') }}',
                                        minLength: 3
                                    }).autocomplete("widget");
                                </script>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>@lang('fi.description'): </label>
                            {!! Form::textarea('description', null, ['id' => 'description', 'rows' => '5', 'class' => 'form-control']) !!}
                        </div>

                        @if ($customFields->count())
                            @include('custom_fields._custom_fields')
                        @endif

                        @if (!$editMode)
                            @if (!config('app.demo'))
                                <div class="form-group">
                                    <label>@lang('fi.attach_files'): </label>
                                    {!! Form::file('attachments[]', ['id' => 'attachments', 'class' => 'form-control', 'multiple' => 'multiple']) !!}
                                </div>
                            @endif
                        @else
                            @include('attachments._table', ['object' => $expense, 'model' => 'FI\Modules\Expenses\Models\Expense'])
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </section>

    {!! Form::close() !!}
@stop