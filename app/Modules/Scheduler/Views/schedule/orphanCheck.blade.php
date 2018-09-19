@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.orphan_check') }}</h1>

        <br>
        <h4>{{ trans('fi.orphan_list') }}</h4>

        <div class="clearfix"></div>

    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-body no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{!! trans('fi.name') !!}</th>
                                <th>{!! trans('fi.workorder_number') !!} </th>
                                <th>{!! trans('fi.job_date') !!}</th>
                                <th>{!! trans('fi.description') !!}</th>
                                <th>{!! trans('fi.client') !!}</th>
                                <th>{{ trans('fi.options') }}</th>
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
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0)" class="btn replace-employee"
                                                       data-item-id="{{ $resource->id }}"
                                                       data-route="{{ route('scheduler.getreplace.employee',[ 'item_id' => $resource->id,'name' => $resource->name, 'date' => $resource->workorder->job_date]) }}">
                                                       <i class="fa fa-sync"></i>{!! trans('fi.replace_employee') !!}</a></li>
                                                <li><a href="{{ route('workorders.edit', [$resource->workorder->id]) }}"><i class="fa fa-edit"></i>{!! trans('fi.edit_workorder') !!}</a></li>
                                            </ul>
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
        </div>
    </section>
@stop
@section('javascript')
    <script>
        $(document).on('click','.replace-employee',function () {
            $('#modal-placeholder').load($(this).attr('data-route'));
        });
    </script>
@stop