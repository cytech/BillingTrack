@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function() {
            $('.filter_options').change(function () {
                $('form#filter').submit();
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('TimeTracking::lang.time_tracking') }}
            <small>{{ trans('TimeTracking::lang.projects') }}</small>
        </h1>

        <div class="pull-right">
            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-control inline']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-control inline']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('timeTracking.projects.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('TimeTracking::lang.create_project') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>{{ trans('fi.status') }}</th>
                                <th>{{ trans('fi.created') }}</th>
                                <th>{{ trans('fi.due_date') }}</th>
                                <th>{{ trans('TimeTracking::lang.project') }}</th>
                                <th>{{ trans('fi.client') }}</th>
                                <th class="text-right">{{ trans('TimeTracking::lang.unbilled_hours') }}</th>
                                <th class="text-right">{{ trans('TimeTracking::lang.billed_hours') }}</th>
                                <th class="text-right">{{ trans('TimeTracking::lang.total_hours') }}</th>
                                <th>{{ trans('fi.options') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->status_text }}</td>
                                    <td>{{ $project->formatted_created_at}}</td>
                                    <td>{{ $project->formatted_due_at}}</td>
                                    <td><a href="{{ route('timeTracking.projects.edit', [$project->id]) }}">{{ $project->name }}</a></td>
                                    <td><a href="{{ route('clients.show', [$project->client->id]) }}">{{ $project->client->name }}</a></td>
                                    <td class="text-right">{{ $project->unbilled_hours }}</td>
                                    <td class="text-right">{{ $project->billed_hours }}</td>
                                    <td class="text-right">{{ $project->hours }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('timeTracking.projects.edit', [$project->id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
                                                <li><a href="{{ route('timeTracking.projects.delete', [$project->id]) }}" onclick="return confirm('{{ trans('TimeTracking::lang.confirm_delete_project') }}');"><i class="fa fa-trash"></i> {{ trans('fi.delete') }}</a></li>
                                            </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

                <div class="pull-right">
                    {!! $projects->appends(request()->except('page'))->render() !!}
                </div>

            </div>

        </div>

    </section>

@stop