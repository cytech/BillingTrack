@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">

        $(function () {

            $(document).on('click','.email-payment-receipt', function () {
                $('#modal-placeholder').load("{{ route('paymentMail.create') }}", {
                    payment_id: $(this).data('payment-id'),
                    redirectTo: $(this).data('redirect-to')
                });
            });

            $('#btn-bulk-delete').click(function () {

                var ids = [];

                $('.bulk-record:checked').each(function () {
                    ids.push($(this).data('id'));
                });

                if (ids.length > 0) {
                    bulkConfirm('{!! trans('fi.bulk_trash_record_warning') !!}', "{{ route('payments.bulk.delete') }}", ids)
                }
            });

        });

    </script>
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.payments') }}</h1>

        <div class="pull-right">

            <a href="javascript:void(0)" class="btn btn-default bulk-actions" id="btn-bulk-delete"><i class="fa fa-trash"></i> {{ trans('fi.delete') }}</a>

        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        @include('payments._dataTable')
                    </div>

                </div>

            </div>

        </div>

    </section>

@stop