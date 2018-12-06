<table class="table table-hover">

    <thead>
    <tr>
        <th>@lang('fi.id')</th>
        <th>@lang('fi.client')</th>
        <th>@lang('fi.summary')</th>
        <th>@lang('fi.next_date')</th>
        <th>@lang('fi.stop_date')</th>
        <th>@lang('fi.every')</th>
        <th style="text-align: right; padding-right: 25px;">@lang('fi.total')</th>
        <th>@lang('fi.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($recurringInvoices as $recurringInvoice)
        <tr>
            <td>
                <a href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}" title="@lang('fi.edit')">{{ $recurringInvoice->id }}</a>
            </td>
            <td>
                <a href="{{ route('clients.show', [$recurringInvoice->client->id]) }}" title="@lang('fi.view_client')">{{ $recurringInvoice->client->unique_name }}</a>
            </td>
            <td>{{ mb_strimwidth($recurringInvoice->summary,0,100,'...') }}</td>
            <td>{{ $recurringInvoice->formatted_next_date }}</td>
            <td>{{ $recurringInvoice->formatted_stop_date }}</td>
            <td>{{ $recurringInvoice->recurring_frequency . ' ' . $frequencies[$recurringInvoice->recurring_period] }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $recurringInvoice->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('fi.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}"><i
                                    class="fa fa-edit"></i> @lang('fi.edit')</a>
                        <a class="dropdown-item" href="{{ route('recurringInvoices.delete', [$recurringInvoice->id]) }}"
                               onclick="return confirm('@lang('fi.trash_record_warning')');"><i
                                    class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>