@extends('layouts.master')

@section('content')

    <section class="content m-3">
        <h1 class="float-left">
            {{ trans('fi.currencies') }}
        </h1>

        <div class="float-right">
            <a href="{{ route('currencies.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
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
                                <th>{!! Sortable::link('name', trans('fi.name')) !!}</th>
                                <th>{!! Sortable::link('code', trans('fi.code')) !!}</th>
                                <th>{!! Sortable::link('symbol', trans('fi.symbol')) !!}</th>
                                <th>{!! Sortable::link('placement', trans('fi.symbol_placement')) !!}</th>
                                <th>{!! Sortable::link('decimal', trans('fi.decimal_point')) !!}</th>
                                <th>{!! Sortable::link('thousands', trans('fi.thousands_separator')) !!}</th>
                                <th>{{ trans('fi.options') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->name }}</td>
                                    <td>{{ $currency->code }}</td>
                                    <td>{{ $currency->symbol }}</td>
                                    <td>{{ $currency->formatted_placement }}</td>
                                    <td>{{ $currency->decimal }}</td>
                                    <td>{{ $currency->thousands }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('currencies.edit', [$currency->id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"
                                                       onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('currencies.delete', [$currency->id]) }}');"><i class="fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
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
                    {!! $currencies->appends(request()->except('page'))->render() !!}
                </div>


    </section>
@stop