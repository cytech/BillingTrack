@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('.filter_options').change(function () {
                $('form#filter').submit();
            });
        });
        $(document).on('click', '#btn-bulk-delete', function () {
            var ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('{!! trans('fi.bulk_trash_record_warning') !!}', "{{ route('timeTracking.projects.bulk.delete') }}", ids)
            }
        });

        $(document).on('click', '.bulk-change-status', function () {
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

    <section class="content mt-3 mb-3">
        <h3 class="float-left">
            {{ trans('fi.time_tracking') }}
            <small>{{ trans('fi.projects') }}</small>
        </h3>

        <div class="float-right">
            <div class="btn-group bulk-actions">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    {{ trans('fi.change_status') }}
                </button>
                <ul class="dropdown-menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <li><a href="javascript:void(0)" class="bulk-change-status"
                               data-status="{{ $key }}">{{ $status }}</a></li>
                    @endforeach
                </ul>
            </div>

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>

            <div class="btn-group form-inline">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('timeTracking.projects.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{ trans('fi.create_project') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')
        <div class="card ">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table dt-responsive display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>

@stop

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        var htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush