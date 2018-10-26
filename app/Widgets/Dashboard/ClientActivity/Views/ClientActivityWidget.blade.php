<div id="client-activity-widget">
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h5 class="text-bold mb-0">{{ trans('fi.recent_client_activity') }}</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>{{ trans('fi.date') }}</th>
                        <th>{{ trans('fi.activity') }}</th>
                    </tr>
                    @foreach ($recentClientActivity as $activity)
                        <tr>
                            <td>{{ $activity->formatted_created_at }}</td>
                            <td>{!! $activity->formatted_activity !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>