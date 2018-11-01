@include('invoices._js_edit_to')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{ trans('fi.to') }}</h3>

        <div class="card-tools float-right">
            <button class="btn btn-default btn-sm" id="btn-change-client"><i
                    class="fa fa-exchange"></i> {{ trans('fi.change') }}</button>
            <button class="btn btn-default btn-sm" id="btn-edit-client" data-client-id="{{ $invoice->client->id }}"><i
                    class="fa fa-pencil"></i> {{ trans('fi.edit') }}</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $invoice->client->name }}</strong><br>
        {!! $invoice->client->formatted_address !!}<br>
        {{ trans('fi.phone') }}: {{ $invoice->client->phone }}<br>
        {{ trans('fi.email') }}: {{ $invoice->client->email }}
    </div>
</div>