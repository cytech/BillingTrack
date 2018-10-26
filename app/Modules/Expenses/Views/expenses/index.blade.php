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

    <section class="content mt-3 mb-3">
        <h3 class="pull-left">
            {{ trans('fi.expenses') }}
        </h3>

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

        <div class="card ">
            <div class="card-body">
                        {!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}
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