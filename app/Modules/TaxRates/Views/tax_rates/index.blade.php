@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.tax_rates')
        </h3>

        <div class="float-right">
            <a href="{{ route('taxRates.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{!! Sortable::link('name', trans('bt.name')) !!}</th>
                        <th>{!! Sortable::link('percent', trans('bt.percent')) !!}</th>
                        <th>{!! Sortable::link('is_compound', trans('bt.compound')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($taxRates as $taxRate)
                        <tr>
                            <td>{{ $taxRate->name }}</td>
                            <td>{{ $taxRate->formatted_percent }}</td>
                            <td>{{ $taxRate->formatted_is_compound }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('taxRates.edit', [$taxRate->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('taxRates.delete', [$taxRate->id]) }}');"><i
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
            {!! $taxRates->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop
