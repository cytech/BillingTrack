@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h1 class="float-left">
            @lang('bt.currencies')
        </h1>

        <div class="float-right">
            <a href="{{ route('currencies.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('bt.new')</a>
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
                                <th>{!! Sortable::link('name', trans('bt.name')) !!}</th>
                                <th>{!! Sortable::link('code', trans('bt.code')) !!}</th>
                                <th>{!! Sortable::link('symbol', trans('bt.symbol')) !!}</th>
                                <th>{!! Sortable::link('placement', trans('bt.symbol_placement')) !!}</th>
                                <th>{!! Sortable::link('decimal', trans('bt.decimal_point')) !!}</th>
                                <th>{!! Sortable::link('thousands', trans('bt.thousands_separator')) !!}</th>
                                <th>@lang('bt.options')</th>
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
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                @lang('bt.options')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('currencies.edit', [$currency->id]) }}"><i class="fa fa-edit"></i> @lang('bt.edit')</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"
                                                       onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('currencies.delete', [$currency->id]) }}');"><i class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
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
