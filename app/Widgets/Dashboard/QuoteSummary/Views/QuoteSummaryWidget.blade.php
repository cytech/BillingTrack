

<div id="quote-dashboard-totals-widget">
    <script type="text/javascript">
        $(function () {
            $('.quote-dashboard-total-change-option').click(function () {
                var option = $(this).data('id');

                $.post("{{ route('widgets.dashboard.quoteSummary.renderPartial') }}", {
                    widgetQuoteSummaryDashboardTotals: option,
                    widgetQuoteSummaryDashboardTotalsFromDate: $('#quote-dashboard-total-setting-from-date').val(),
                    widgetQuoteSummaryDashboardTotalsToDate: $('#quote-dashboard-total-setting-to-date').val()
                }, function (data) {
                    $('#quote-dashboard-totals-widget').html(data);
                });

            });

            $('#quote-dashboard-total-setting-from-date').datetimepicker({format: 'Y-m-d', timepicker: false, scrollInput: false});
            $('#quote-dashboard-total-setting-to-date').datetimepicker({format: 'Y-m-d', timepicker: false, scrollInput: false});
        });
    </script>
    <div class="card">
        <div class="card-header ">
            <h5 class="text-bold mb-0">@lang('bt.quote_summary')</h5>
            <div class="card-tools pull-right">
                <div class="btn-group">
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-calendar"></i> {{ $quoteDashboardTotalOptions[config('bt.widgetQuoteSummaryDashboardTotals')] }}
                        </button>
                        <div class="dropdown-menu" role="menu">
                            @foreach ($quoteDashboardTotalOptions as $key => $option)
                                {{--<li>--}}
                                @if ($key != 'custom_date_range')
                                    <a href="#" onclick="return false;"
                                       class="quote-dashboard-total-change-option dropdown-item"
                                       data-id="{{ $key }}">{{ $option }}</a>
                                @else
                                    <a href="#" onclick="return false;" data-toggle="modal"
                                       data-target="#quote-summary-widget-modal" class="dropdown-item">{{ $option }}</a>
                                @endif
                                {{--</li>--}}
                            @endforeach
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm create-quote"><i class="fa fa-plus"></i> @lang('bt.create_quote')
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="small-box bg-purple ">
                        <div class="inner">
                            <h4 class="text-bold">{{ $quotesTotalDraft }}</h4>

                            <p>@lang('bt.draft_quotes')</p>
                        </div>
                        <div class="icon"><i class="fa fa-pencil-alt"></i></div>
                        <a class="small-box-footer" href="{{ route('quotes.index') }}?status=draft">
                            @lang('bt.view_draft_quotes') <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h4 class="text-bold">{{ $quotesTotalSent }}</h4>

                            <p>@lang('bt.sent_quotes')</p>
                        </div>
                        <div class="icon"><i class="fa fa-share-square"></i></div>
                        <a class="small-box-footer" href="{{ route('quotes.index') }}?status=sent">
                            @lang('bt.view_sent_quotes') <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h4 class="text-bold">{{ $quotesTotalRejected }}</h4>

                            <p>@lang('bt.rejected_quotes')</p>
                        </div>
                        <div class="icon"><i class="fa fa-thumbs-down"></i></div>
                        <a class="small-box-footer" href="{{ route('quotes.index') }}?status=rejected">
                            @lang('bt.view_rejected_quotes') <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h4 class="text-bold">{{ $quotesTotalApproved }}</h4>

                            <p>@lang('bt.approved_quotes')</p>
                        </div>
                        <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                        <a class="small-box-footer" href="{{ route('quotes.index') }}?status=approved">
                            @lang('bt.view_approved_quotes') <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quote-summary-widget-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('bt.custom_date_range')</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('bt.from_date') (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetQuoteSummaryDashboardTotalsFromDate', config('bt.widgetQuoteSummaryDashboardTotalsFromDate'), ['class' => 'form-control', 'id' => 'quote-dashboard-total-setting-from-date']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.to_date') (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetQuoteSummaryDashboardTotalsToDate', config('bt.widgetQuoteSummaryDashboardTotalsToDate'), ['class' => 'form-control', 'id' => 'quote-dashboard-total-setting-to-date']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('bt.cancel')</button>
                    <button type="button" class="btn btn-primary quote-dashboard-total-change-option"
                            data-id="custom_date_range" data-dismiss="modal">@lang('bt.save')</button>
                </div>
            </div>
        </div>
    </div>
</div>
