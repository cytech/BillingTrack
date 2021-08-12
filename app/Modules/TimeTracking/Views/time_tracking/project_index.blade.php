@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        $(function () {
            $('.filter_options').change(function () {
                $('form#filter').submit();
            });
        });
        $(document).on('click', '#btn-bulk-delete', function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_trash_record_warning')', '', "{{ route('timeTracking.projects.bulk.delete') }}", ids)
            }
        });

        $(document).on('click', '.bulk-change-status', function () {
            const ids = [];

            $('.bulk-record:checked').each(function () {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                bulkConfirm('@lang('bt.bulk_project_change_status_warning')', '', "{{ route('timeTracking.projects.bulk.status') }}",
                    ids, $(this).data('status'))
            }
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.time_tracking')
            <small>@lang('bt.projects')</small>
        </h3>

        <div class="float-right">
            <div class="btn-group bulk-actions">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    @lang('bt.change_status')
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                    @foreach ($keyedStatuses as $key => $status)
                        <a href="javascript:void(0)" class="bulk-change-status dropdown-item"
                               data-status="{{ $key }}">{{ $status }}</a>
                    @endforeach
                </div>
            </div>

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i
                        class="fa fa-trash"></i> @lang('bt.trash')</a>

            <div class="btn-group form-inline">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('timeTracking.projects.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('bt.create_project')</a>
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
        const htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush
