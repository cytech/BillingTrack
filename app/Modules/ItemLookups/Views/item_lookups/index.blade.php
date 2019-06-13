@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.item_lookups')</h3>

        <div class="float-right">
            <a href="{{ route('itemLookups.create') }}" class="btn btn-primary "><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <table id="dt-itemlookupstable" class="table dataTable no-footer">
                    <thead>
                    <tr>
                        <th>@lang('bt.name')</th>
                        <th>@lang('bt.description')</th>
                        <th>@lang('bt.price')</th>
                        <th>@lang('bt.tax_1')</th>
                        <th>@lang('bt.tax_2')</th>
                        <th>@lang('bt.options')</th>
                        <th class="d-none">resource_table</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($itemLookups as $itemLookup)
                        <tr>
                            <td>{!! $itemLookup->formatted_name !!}</td>
                            <td>{{ $itemLookup->description }}</td>
                            <td>{{ $itemLookup->formatted_price }}</td>
                            <td>{{ $itemLookup->taxRate->name ?? '' }}</td>
                            <td>{{ $itemLookup->taxRate2->name ?? '' }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                           href="{{ route('itemLookups.edit', [$itemLookup->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '{{ route('itemLookups.delete', [$itemLookup->id]) }}');"><i
                                                    class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none">{{ $itemLookup->resource_table }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
