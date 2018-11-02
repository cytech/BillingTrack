@include('workorders.partials._js_edit_to')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('fi.to') }}</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-client"><i
                        class="fa fa-exchange"></i> {{ trans('fi.change') }}</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-client" data-client-id="{{ $workorder->client->id }}"><i
                        class="fa fa-pencil"></i> {{ trans('fi.edit') }}</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $workorder->client->name }}</strong><br>
        {!! $workorder->client->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $workorder->client->phone }}<br>
        {{ trans('fi.email') }}: {{ $workorder->client->email }}
    </div>
</div>