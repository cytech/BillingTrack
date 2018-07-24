@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function() {
            $('.filter_options').change(function () {
                $('form#filter').submit();
            });
        });
        $(document).on('click','#btn-bulk-delete', function () {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('{!! trans('fi.bulk_trash_record_warning') !!}', "{{ route('timeTracking.projects.bulk.delete') }}", ids)
            }
        });

        $(document).on('click','.bulk-change-status', function() {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('{!! trans('fi.bulk_project_change_status_warning') !!}', "{{ route('timeTracking.projects.bulk.status') }}",
                    ids, $(this).data('status'))
            }
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.time_tracking') }}
            <small>{{ trans('fi.projects') }}</small>
        </h1>

        <div class="pull-right">
            <div class="btn-group bulk-actions">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ trans('fi.change_status') }} <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <li><a href="javascript:void(0)" class="bulk-change-status" data-status="{{ $key }}">{{ $status }}</a></li>
                    @endforeach
                </ul>
            </div>

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>

            <div class="btn-group form-inline">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('timeTracking.projects.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('fi.create_project') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">

                        {{--<table class="table table-hover">--}}

                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>{{ trans('fi.status') }}</th>--}}
                                {{--<th>{{ trans('fi.created') }}</th>--}}
                                {{--<th>{{ trans('fi.due_date') }}</th>--}}
                                {{--<th>{{ trans('fi.project') }}</th>--}}
                                {{--<th>{{ trans('fi.client') }}</th>--}}
                                {{--<th class="text-right">{{ trans('fi.unbilled_hours') }}</th>--}}
                                {{--<th class="text-right">{{ trans('fi.billed_hours') }}</th>--}}
                                {{--<th class="text-right">{{ trans('fi.total_hours') }}</th>--}}
                                {{--<th>{{ trans('fi.options') }}</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}

                            {{--<tbody>--}}
                            {{--@foreach ($projects as $project)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ $project->status_text }}</td>--}}
                                    {{--<td>{{ $project->formatted_created_at}}</td>--}}
                                    {{--<td>{{ $project->formatted_due_at}}</td>--}}
                                    {{--<td><a href="{{ route('timeTracking.projects.edit', [$project->id]) }}">{{ $project->name }}</a></td>--}}
                                    {{--<td><a href="{{ route('clients.show', [$project->client->id]) }}">{{ $project->client->name }}</a></td>--}}
                                    {{--<td class="text-right">{{ $project->unbilled_hours }}</td>--}}
                                    {{--<td class="text-right">{{ $project->billed_hours }}</td>--}}
                                    {{--<td class="text-right">{{ $project->hours }}</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="btn-group">--}}
                                            {{--<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">--}}
                                                {{--{{ trans('fi.options') }} <span class="caret"></span>--}}
                                            {{--</button>--}}
                                            {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                                                {{--<li><a href="{{ route('timeTracking.projects.edit', [$project->id]) }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>--}}
                                                {{--<li><a href="#"--}}
                                                       {{--onclick="swalConfirm('{{ trans('fi.confirm_delete_project') }}', '{{ route('timeTracking.projects.delete', [$project->id]) }}');"><i--}}
                                                                {{--class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>--}}
                                            {{--</ul>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}

                        {{--</table>--}}

                        {!! $dataTable->table() !!}

                    </div>

                </div>

               {{-- <div class="pull-right">
                    {!! $projects->appends(request()->except('page'))->render() !!}
                </div>--}}

            </div>

        </div>

    </section>

@stop

@push('scripts')
    {{--<link rel="stylesheet" href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">--}}
    {{--<script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="/vendor/datatables/buttons.server-side.js"></script>--}}
    {!! $dataTable->scripts() !!}
    <script>
        var htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush