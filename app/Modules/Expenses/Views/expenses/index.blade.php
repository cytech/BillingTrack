@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $(document).on('click','.btn-bill-expense', (function () {
                $('#modal-placeholder').load("{{ route('expenseBill.create') }}", {
                    id: $(this).data('expense-id'),
                    redirectTo: '{{ request()->fullUrl() }}'
                });
            }));

            $('.expense_filter_options').change(function () {
                $('form#filter').submit();
            });

            $('#btn-bulk-delete').click(function () {

                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('{!! trans('fi.bulk_trash_record_warning') !!}', "{{ route('expenses.bulk.delete') }}", ids)
                }
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.expenses') }}
        </h1>

        <div class="pull-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> {{ trans('fi.trash') }}</a>

            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('category', $categories, request('category'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('vendor', $vendors, request('vendor'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">

                        {!! $dataTable->table() !!}
                    </div>

                </div>

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