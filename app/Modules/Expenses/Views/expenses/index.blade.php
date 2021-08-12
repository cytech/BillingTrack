@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        $(function () {
            $(document).on('click','.btn-bill-expense', (function () {
                $('#modal-placeholder').load("{{ route('expenses.expenseBill.create') }}", {
                    id: $(this).data('expense-id'),
                    redirectTo: '{{ request()->fullUrl() }}'
                });
            }));

            $('.expense_filter_options').change(function () {
                $('form#filter').submit();
            });

            $('#btn-bulk-delete').click(function () {

                const ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('@lang('bt.bulk_trash_record_warning')', '', "{{ route('expenses.bulk.delete') }}", ids)
                }
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.expenses')
        </h3>

        <div class="float-right">

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> @lang('bt.trash')</a>

            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class'=>"form-inline"]) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('category', $categories, request('category'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::select('vendor', $vendors, request('vendor'), ['class' => 'expense_filter_options form-control ']) !!}
                {!! Form::close() !!}
            </div>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('bt.new')</a>
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
        const htmlstr = '<input type="checkbox" class="btn-group" id="bulk-select-all"/> ';
        $('.bulk-record').html(htmlstr)
    </script>
@endpush
