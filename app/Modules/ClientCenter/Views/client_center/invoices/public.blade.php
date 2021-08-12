@extends('client_center.layouts.public')

@section('javaScript')

    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#view-notes').hide();
            $('.btn-notes').click(function () {
                $('#view-doc').toggle();
                $('#view-notes').toggle();
                $('#' + $(this).data('button-toggle')).show();
                $(this).hide();
            });

            $('.btn-pay').click(function () {
                const $btn = $(this).button('loading');

                $.post("{{ route('merchant.pay') }}", {
                    driver: $(this).data('driver'),
                    urlKey: '{{ $invoice->url_key }}'
                }).done(function (response) {
                    if (response.redirect === 1) {
                        window.location = response.url;
                    }
                    else {
                        $('#modal-placeholder').html(response.modalContent);
                    }
                });
            });
        });
    </script>
@stop

@section('content')

    <section class="content">

        <div class="public-wrapper">

            @include('layouts._alerts')

            <div style="margin-bottom: 15px;">

                <a href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"
                   class="btn btn-primary"><i class="fa fa-print"></i> <span>@lang('bt.pdf')</span>
                </a>

                @if (auth()->check())
                    <a href="javascript:void(0)" id="btn-notes" data-button-toggle="btn-notes-back" class="btn btn-primary btn-notes">
                        <i class="fa fa-comments"></i> @lang('bt.notes')
                    </a>
                    <a href="javascript:void(0)" id="btn-notes-back" data-button-toggle="btn-notes" class="btn btn-primary btn-notes" style="display: none;">
                        <i class="fa fa-backward"></i> @lang('bt.back_to_invoice')
                    </a>
                @endif

                @if (count($attachments))
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-files-o"></i> @lang('bt.attachments')
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($attachments as $attachment)
                                <li><a href="{{ $attachment->download_url }}">{{ $attachment->filename }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($invoice->isPayable)
                    @foreach ($merchantDrivers as $driver)
                        <a href="javascript:void(0)" class="btn btn-primary btn-pay" data-driver="{{ $driver->getName() }}" data-loading-text="@lang('bt.please_wait')"><i class="fa fa-credit-card"></i> {{ $driver->getSetting('paymentButtonText') }}</a>
                    @endforeach
                @endif
            </div>

            <div class="public-doc-wrapper">

                <div id="view-doc">
                    <iframe src="{{ route('clientCenter.public.invoice.html', [$urlKey]) }}"
                            style="width: 100%;" onload="resizeIframe(this, 800);"></iframe>
                </div>

                @if (auth()->check())
                    <div id="view-notes">
                        @include('notes._notes', ['object' => $invoice, 'model' => 'BT\Modules\Invoices\Models\Invoice'])
                    </div>
                @endif

            </div>

        </div>

    </section>

@stop
