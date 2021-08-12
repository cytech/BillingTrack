@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.custom_fields')
        </h3>

        <div class="float-right">
            <a href="{{ route('customFields.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')

        <div class="card card-light">

            <div class="card-body">
                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th>{!! Sortable::link('tbl_name', trans('bt.table_name')) !!}</th>
                        <th>{!! Sortable::link('column_name', trans('bt.column_name')) !!}</th>
                        <th>{!! Sortable::link('field_label', trans('bt.field_label')) !!}</th>
                        <th>{!! Sortable::link('field_type', trans('bt.field_type')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($customFields as $customField)
                        <tr>
                            <td>{{ $tableNames[$customField->tbl_name] }}</td>
                            <td>{{ $customField->column_name }}</td>
                            <td>{{ $customField->field_label }}</td>
                            <td>{{ $customField->field_type }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('customFields.edit', [$customField->id]) }}"><i
                                                        class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                               onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('customFields.delete', [$customField->id]) }}');"><i
                                                        class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        <div class="float-right">
            {!! $customFields->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop
