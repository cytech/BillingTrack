<div id="todays-workorders-widget">
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('bt.todays_workorders')</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>@lang('bt.client')</th>
                        <th>@lang('bt.start_time')</th>
                        <th>@lang('bt.end_time')</th>
                        <th>@lang('bt.will_call')</th>
                        <th>@lang('bt.workorder_link')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todaysWorkorders as $workorder)
                        <tr id="{!! $workorder->id !!}">
                            <td>{!! $workorder->client->name !!}</td>
                            <td>{!! $workorder->start_time !!}</td>
                            <td>{!! $workorder->end_time !!}</td>
                            <td>{!! ($workorder->will_call == 1 )?'Yes':'No' !!}</td>
                            <td><a href="{!! url('/workorders') . '/' . $workorder->id . '/edit' !!}">
                                    @lang('bt.link_to_workorder')</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
