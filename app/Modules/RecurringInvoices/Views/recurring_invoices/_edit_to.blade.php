@include('recurring_invoices._js_edit_to')

<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">@lang('fi.to')</h3>

        <div class="card-tools float-right">
            <button class="btn btn-secondary btn-sm" id="btn-change-client"><i
                    class="fa fa-exchange"></i> @lang('fi.change')</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-client" data-client-id="{{ $recurringInvoice->client->id }}"><i
                    class="fa fa-pencil"></i> @lang('fi.edit')</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $recurringInvoice->client->name }}</strong><br>
        {!! $recurringInvoice->client->formatted_address !!}<br>
        @lang('fi.phone'): {{ $recurringInvoice->client->phone }}<br>
        @lang('fi.email'): {{ $recurringInvoice->client->email }}
    </div>
</div>