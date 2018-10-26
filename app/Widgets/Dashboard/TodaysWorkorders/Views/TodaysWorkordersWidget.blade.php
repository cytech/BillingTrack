<div id="todays-workorders-widget">
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h5 class="text-bold mb-0">{{ trans('fi.todays_workorders') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                    <thead>
                    <tr>
                        <th>{{ trans('fi.client') }}</th>
                        <th>{{ trans('fi.start_time') }}</th>
                        <th>{{ trans('fi.end_time') }}</th>
                        <th>{{ trans('fi.will_call') }}</th>
                        <th>{{ trans('fi.workorder_link') }}</th>
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
                                    {{ trans('fi.link_to_workorder') }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>