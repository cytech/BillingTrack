@include('workorders.partials._js_edit_to')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('bt.to')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-client"><i
                        class="fa fa-exchange"></i> @lang('bt.change')</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-client" data-client-id="{{ $workorder->client->id }}"><i
                        class="fa fa-pencil"></i> @lang('bt.edit')</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $workorder->client->name }}</strong><br>
        {!! $workorder->client->formatted_address !!}<br>
        @lang('bt.phone'): {{ $workorder->client->phone }}<br>
        @lang('bt.email'): {{ $workorder->client->email }}
    </div>
</div>
