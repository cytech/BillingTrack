@include('layouts._datepicker')

<div id="workorder-dashboard-totals-widget">
    <script type="text/javascript">
        $(function () {
            $('.workorder-dashboard-total-change-option').click(function () {
                var option = $(this).data('id');

                $.post("{{ route('widgets.dashboard.workorderSummary.renderPartial') }}", {
                    widgetWorkorderSummaryDashboardTotals: option,
                    widgetWorkorderSummaryDashboardTotalsFromDate: $('#workorder-dashboard-total-setting-from-date').val(),
                    widgetWorkorderSummaryDashboardTotalsToDate: $('#workorder-dashboard-total-setting-to-date').val()
                }, function (data) {
                    $('#workorder-dashboard-totals-widget').html(data);
                });

            });

            $('#workorder-dashboard-total-setting-from-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#workorder-dashboard-total-setting-to-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold mb-0">{{ trans('fi.workorder_summary') }}</h5>
                <div class="card-tools pull-right">
                    <div class="btn-group">
                        <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-calendar"></i> {{ $workorderDashboardTotalOptions[config('fi.widgetWorkorderSummaryDashboardTotals')] }}
                        </button>
                        <div class="dropdown-menu" role="menu">
                            @foreach ($workorderDashboardTotalOptions as $key => $option)
                                {{--<li>--}}
                                    @if ($key != 'custom_date_range')
                                        <a href="#" onclick="return false;" class="workorder-dashboard-total-change-option dropdown-item" data-id="{{ $key }}">{{ $option }}</a>
                                    @else
                                        <a href="#" onclick="return false;" data-toggle="modal" data-target="#workorder-summary-widget-modal" class="dropdown-item">{{ $option }}</a>
                                    @endif
                                {{--</li>--}}
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <button class="btn btn-sm create-workorder"><i class="fa fa-plus"></i> {{ trans('fi.create_workorder') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h4 class="text-bold">{{ $workordersTotalDraft }}</h4>

                                <p>{{ trans('fi.draft_workorders') }}</p>
                            </div>
                            <div class="icon"><i class="fa fa-pencil-alt"></i></div>
                            <a class="small-box-footer" href="{{ route('workorders.index') }}?status=draft">
                                {{ trans('fi.view_draft_workorders') }} <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4 class="text-bold">{{ $workordersTotalSent }}</h4>

                                <p>{{ trans('fi.sent_workorders') }}</p>
                            </div>
                            <div class="icon"><i class="fa fa-share-square"></i></div>
                            <a class="small-box-footer" href="{{ route('workorders.index') }}?status=sent">
                                {{ trans('fi.view_sent_workorders') }} <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h4 class="text-bold">{{ $workordersTotalRejected }}</h4>

                                <p>{{ trans('fi.rejected_workorders') }}</p>
                            </div>
                            <div class="icon"><i class="fa fa-thumbs-down"></i></div>
                            <a class="small-box-footer" href="{{ route('workorders.index') }}?status=rejected">
                                {{ trans('fi.view_rejected_workorders') }} <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h4 class="text-bold">{{ $workordersTotalApproved }}</h4>

                                <p>{{ trans('fi.approved_workorders') }}</p>
                            </div>
                            <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                            <a class="small-box-footer" href="{{ route('workorders.index') }}?status=approved">
                                {{ trans('fi.view_approved_workorders') }} <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal fade" id="workorder-summary-widget-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('fi.custom_date_range') }}</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>{{ trans('fi.from_date') }} (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetWorkorderSummaryDashboardTotalsFromDate', config('fi.widgetWorkorderSummaryDashboardTotalsFromDate'), ['class' => 'form-control', 'id' => 'workorder-dashboard-total-setting-from-date']) !!}
                    </div>

                    <div class="form-group">
                        <label>{{ trans('fi.to_date') }} (yyyy-mm-dd):</label>
                        {!! Form::text('setting_widgetWorkorderSummaryDashboardTotalsToDate', config('fi.widgetWorkorderSummaryDashboardTotalsToDate'), ['class' => 'form-control', 'id' => 'workorder-dashboard-total-setting-to-date']) !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                    <button type="button" class="btn btn-primary workorder-dashboard-total-change-option" data-id="custom_date_range" data-dismiss="modal">{{ trans('fi.save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>