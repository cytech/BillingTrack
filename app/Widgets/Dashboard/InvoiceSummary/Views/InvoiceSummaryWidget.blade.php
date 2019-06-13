

<div id="invoice-dashboard-totals-widget">
    <script type="text/javascript">
        $(function () {
            $('.invoice-dashboard-total-change-option').click(function () {
                var option = $(this).data('id');

                $.post("{{ route('widgets.dashboard.invoiceSummary.renderPartial') }}", {
                    widgetInvoiceSummaryDashboardTotals: option,
                    widgetInvoiceSummaryDashboardTotalsFromDate: $('#invoice-dashboard-total-setting-from-date').val(),
                    widgetInvoiceSummaryDashboardTotalsToDate: $('#invoice-dashboard-total-setting-to-date').val()
                }, function (data) {
                    $('#invoice-dashboard-totals-widget').html(data);
                });

            });

            $('#invoice-dashboard-total-setting-from-date').datetimepicker({format: 'Y-m-d', timepicker: false, scrollInput: false});
            $('#invoice-dashboard-total-setting-to-date').datetimepicker({format: 'Y-m-d', timepicker: false, scrollInput: false});
        });
    </script>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('bt.invoice_summary')</h5>
                <div class="card-tools pull-right">
                    <div class="btn-group">
                        <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-calendar"></i> {{ $invoiceDashboardTotalOptions[config('bt.widgetInvoiceSummaryDashboardTotals')] }}
                        </button>
                        <div class="dropdown-menu" role="menu">
                            @foreach ($invoiceDashboardTotalOptions as $key => $option)
                                <li>
                                    @if ($key != 'custom_date_range')
                                        <a href="#" onclick="return false;" class="invoice-dashboard-total-change-option  dropdown-item" data-id="{{ $key }}">{{ $option }}</a>
                                    @else
                                        <a href="#" onclick="return false;" data-toggle="modal" data-target="#invoice-summary-widget-modal" class="dropdown-item">{{ $option }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <button class="btn btn-sm create-invoice"><i class="fa fa-plus"></i> @lang('bt.create_invoice')</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h4 class="text-bold">{{ $invoicesTotalDraft }}</h4>

                                <p>@lang('bt.draft_invoices')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil-alt"></i>
                            </div>
                            <a href="{{ route('invoices.index') }}?status=draft" class="small-box-footer">
                                @lang('bt.view_draft_invoices') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4 class="text-bold">{{ $invoicesTotalSent }}</h4>

                                <p>@lang('bt.sent_invoices')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-share-square"></i>
                            </div>
                            <a class="small-box-footer" href="{{ route('invoices.index') }}?status=sent">
                                @lang('bt.view_sent_invoices') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h4 class="text-bold">{{ $invoicesTotalOverdue }}</h4>

                                <p>@lang('bt.overdue_invoices')</p>
                            </div>
                            <div class="icon"><i class="fa fa-exclamation"></i></div>
                            <a class="small-box-footer" href="{{ route('invoices.index') }}?status=overdue">
                                @lang('bt.view_overdue_invoices') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h4 class="text-bold">{{ $invoicesTotalPaid }}</h4>

                                <p>@lang('bt.payments_collected')</p>
                            </div>
                            <div class="icon"><i class="fa fa-heart"></i></div>
                            <a class="small-box-footer" href="{{ route('payments.index') }}">
                                @lang('bt.view_payments') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="invoice-summary-widget-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('bt.custom_date_range')</h4>                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>@lang('bt.from_date') (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetInvoiceSummaryDashboardTotalsFromDate', config('bt.widgetInvoiceSummaryDashboardTotalsFromDate'), ['class' => 'form-control', 'id' => 'invoice-dashboard-total-setting-from-date']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.to_date') (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetInvoiceSummaryDashboardTotalsToDate', config('bt.widgetInvoiceSummaryDashboardTotalsToDate'), ['class' => 'form-control', 'id' => 'invoice-dashboard-total-setting-to-date']) !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('bt.cancel')</button>
                    <button type="button" class="btn btn-primary invoice-dashboard-total-change-option" data-id="custom_date_range" data-dismiss="modal">@lang('bt.save')</button>
                </div>
            </div>
        </div>
    </div>
</div>
