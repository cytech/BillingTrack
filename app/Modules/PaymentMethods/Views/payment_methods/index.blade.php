@extends('layouts.master')

@section('content')

    <section class="content p-3">
        <h3 class="float-left">
            @lang('fi.payment_methods')
        </h3>
        <div class="float-right">
            <a href="{{ route('paymentMethods.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('fi.new')</a>
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
                        <th>{!! Sortable::link('name', trans('fi.payment_method')) !!}</th>
                        <th>@lang('fi.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($paymentMethods as $paymentMethod)
                        <tr>
                            <td>{{ $paymentMethod->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('fi.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                           href="{{ route('paymentMethods.edit', [$paymentMethod->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('fi.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('fi.delete_record_warning')', '{{ route('paymentMethods.delete', [$paymentMethod->id]) }}');"><i
                                                    class="fa fa-trash-alt"></i> @lang('fi.delete')</a>
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
            {!! $paymentMethods->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop