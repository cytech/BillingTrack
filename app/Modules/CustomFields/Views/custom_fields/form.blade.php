@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($customField, ['route' => ['customFields.update', $customField->id]]) !!}
    @else
        {!! Form::open(['route' => 'customFields.store']) !!}
    @endif

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.custom_field_form') }}
        </h3>
        <div class="float-right">
            <button class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('fi.save') }}</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')


        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('fi.table_name') }}: </label>
                    @if ($editMode == true)
                        {!! Form::text('tbl_name', $tableNames[$customField->tbl_name], ['id' => 'tbl_name', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                    @else
                        {!! Form::select('tbl_name', $tableNames, null, ['id' => 'tbl_name', 'class' => 'form-control']) !!}
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ trans('fi.field_label') }}: </label>
                    {!! Form::text('field_label', null, ['id' => 'field_label', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>{{ trans('fi.field_type') }}: </label>
                    {!! Form::select('field_type', $fieldTypes, null, ['id' => 'field_type', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>{{ trans('fi.field_meta') }}: </label>
                    {!! Form::text('field_meta', null, ['id' => 'field_meta', 'class' => 'form-control']) !!}
                    <span class="help-block">{{ trans('fi.field_meta_description') }}</span>
                </div>

            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop