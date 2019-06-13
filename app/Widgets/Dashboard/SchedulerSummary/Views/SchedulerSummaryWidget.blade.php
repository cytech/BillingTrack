<div id="scheduler-dashboard-totals-widget">
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('bt.schedule_summary')</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <div><h4 class="text-bold">{!! $schedulerEvents['monthEvent'] !!}</h4></div>
                                <p>@lang('bt.events_this_month')</p>
                            </div>
                            <div class="icon"><i class="fa fa-calendar"></i></div>
                            <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}">
                                @lang('bt.vevents_this_month')
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <div><h4 class="text-bold">{!! $schedulerEvents['lastMonthEvent'] !!}</h4></div>
                                <p>@lang('bt.events_last_month')</p>
                            </div>
                            <div class="icon"><i class="fa fa-calendar"></i></div>
                            <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=last">
                                @lang('bt.vevents_last_month')
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <div><h4 class="text-bold">{!! $schedulerEvents['nextMonthEvent'] !!}</h4></div>
                                <p>@lang('bt.events_next_month')</p>
                            </div>
                            <div class="icon"><i class="fa fa-calendar"></i></div>
                            <a class="small-box-footer" href="{!! route('scheduler.fullcalendar') !!}?status=next">
                                @lang('bt.vevents_next_month')
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <div><h4 class="text-bold">{!! count($schedulerEvents['reminders']) !!}</h4></div>
                                <p>@lang('bt.reminders')</p>
                            </div>
                            <div class="icon"><i class="fa fa-bell"></i></div>
                            <a class="small-box-footer" href="{!! route('scheduler.index') !!}">
                                @lang('bt.schedule_dashboard')
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
