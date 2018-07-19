@include('Workorders::workorders.partials._js_edit_to')

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{ trans('fi.to') }}</h3>

        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" id="btn-change-client"><i
                        class="fa fa-exchange"></i> {{ trans('fi.change') }}</button>
            <button class="btn btn-default btn-sm" id="btn-edit-client" data-client-id="{{ $workorder->client->id }}"><i
                        class="fa fa-pencil"></i> {{ trans('fi.edit') }}</button>
        </div>
    </div>
    <div class="box-body">
        <strong>{{ $workorder->client->name }}</strong><br>
        {!! $workorder->client->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $workorder->client->phone }}<br>
        {{ trans('fi.email') }}: {{ $workorder->client->email }}
    </div>
</div>