@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">

        $(function () {

            $(document).on('click','.email-payment-receipt', function () {
                $('#modal-placeholder').load("{{ route('payments.paymentMail.create') }}", {
                    payment_id: $(this).data('payment-id'),
                    redirectTo: $(this).data('redirect-to')
                });
            });

            $('#btn-bulk-delete').click(function () {

                const ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('@lang('bt.bulk_trash_record_warning')', '', "{{ route('payments.bulk.delete') }}", ids)
                }
            });

        });

    </script>
@stop

@section('content')

    <section class="content-header">
        <h3 class="float-left">@lang('bt.payments')</h3>

        <div class="float-right">

            <a href="javascript:void(0)" class="btn btn-secondary bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> @lang('bt.trash')</a>

            <a href="javascript:void(0)" id="btn-enter-multi-payment" class="btn btn-primary enter-multi-payment"
               data-redirect-to="{{ request()->fullUrl() }}"><i
                        class="fa fa-credit-card"></i> @lang('bt.enter_payment')</a>

        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="card ">
            <div class="card-body">
                        @include('layouts._dataTable')
                    </div>

                </div>

    </section>

@stop
