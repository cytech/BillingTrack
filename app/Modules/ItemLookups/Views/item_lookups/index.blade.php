@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.item_lookups') }}
        </h1>
        <div class="pull-right">
            <a href="{{ route('itemLookups.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        <table id="dt-itemlookupstable" class="table dataTable no-footer">

                            <thead>
                            <tr>
                                <th>{{ trans('fi.name') }}</th>
                                <th>{{ trans('fi.description') }}</th>
                                <th>{{ trans('fi.price') }}</th>
                                <th>{{ trans('fi.tax_1') }}</th>
                                <th>{{ trans('fi.tax_2') }}</th>
                                <th>{{ trans('fi.options') }}</th>
                                <th class="hidden">resource_table</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($itemLookups as $itemLookup)
                                <tr>
                                    <td>{!! $itemLookup->formatted_name !!}</td>
                                    <td>{{ $itemLookup->description }}</td>
                                    <td>{{ $itemLookup->formatted_price }}</td>
                                    <td>{{ $itemLookup->taxRate->name or '' }}</td>
                                    <td>{{ $itemLookup->taxRate2->name or '' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('itemLookups.edit', [$itemLookup->id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
                                                <li><a href="#"
                                                       onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('itemLookups.delete', [$itemLookup->id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="hidden">{{ $itemLookup->resource_table }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

                {{--<div class="pull-right">--}}
                    {{--{!! $itemLookups->appends(request()->except('page'))->render() !!}--}}
                {{--</div>--}}

            </div>

        </div>

    </section>
    <script>
        $(function () {
            {{--for itemlookups DT--}}
            $('#dt-itemlookupstable').DataTable({
                paging: false,
                order: [[6, "asc"], [0, "asc"]],//order on hidden resource table then name
                "columnDefs": [
                    {"orderable": false, "targets": 5}
                ]
            });
        });
    </script>

@stop
