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

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.custom_field_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('customFields.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')


        <div class=" card card-light">
            <div class="card-body">
                <div class="form-group">
                    <label>@lang('bt.table_name'): </label>
                    @if ($editMode == true)
                        {!! Form::text('tbl_name', $tableNames[$customField->tbl_name], ['id' => 'tbl_name', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                    @else
                        {!! Form::select('tbl_name', $tableNames, null, ['id' => 'tbl_name', 'class' => 'form-control']) !!}
                    @endif
                </div>

                <div class="form-group">
                    <label>@lang('bt.field_label'): </label>
                    {!! Form::text('field_label', null, ['id' => 'field_label', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>@lang('bt.field_type'): </label>
                    {!! Form::select('field_type', $fieldTypes, null, ['id' => 'field_type', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>@lang('bt.field_meta'): </label>
                    {!! Form::text('field_meta', null, ['id' => 'field_meta', 'class' => 'form-control']) !!}
                    <span class="form-text text-muted">@lang('bt.field_meta_description')</span>
                </div>

            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
