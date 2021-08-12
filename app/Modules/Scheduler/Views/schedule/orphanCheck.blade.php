@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div>
        <h3 class="float-left">@lang('bt.orphan_check')</h3>
        </div>
        <br>
        <br>
        <div>
        <h4 class="float-left">@lang('bt.orphan_list')</h4>
        </div>
        <div class="clearfix"></div>

    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>@lang('bt.name')</th>
                                <th>@lang('bt.workorder_number') </th>
                                <th>@lang('bt.job_date')</th>
                                <th>@lang('bt.description')</th>
                                <th>@lang('bt.client')</th>
                                <th>@lang('bt.options')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($empresources as $resource)
                                <tr>
                                    <td>{{ $resource->name }}</td>
                                    <td>{{ $resource->workorder->number }}</td>
                                    <td>{{ $resource->workorder->formatted_job_date }}</td>
                                    <td>{{ $resource->workorder->summary }}</td>
                                    <td>{{ $resource->workorder->client->unique_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                @lang('bt.options')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="btn replace-employee dropdown-item" href="javascript:void(0)"
                                                       data-item-id="{{ $resource->id }}"
                                                       data-route="{{ route('scheduler.getreplace.employee',[ 'item_id' => $resource->id,'name' => $resource->name, 'date' => $resource->workorder->job_date]) }}">
                                                       <i class="fa fa-sync"></i> @lang('bt.replace_employee')</a>
                                                <a class="dropdown-item" href="{{ route('workorders.edit', [$resource->workorder->id]) }}"><i class="fa fa-edit"></i> @lang('bt.edit_workorder')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javaScript')
    <script>
        $(document).on('click','.replace-employee',function () {
            $('#modal-placeholder').load($(this).attr('data-route'));
        });
    </script>
@stop
