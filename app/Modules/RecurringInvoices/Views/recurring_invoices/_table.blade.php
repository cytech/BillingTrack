<table class="table table-hover">

    <thead>
    <tr>
        <th>@lang('bt.id')</th>
        <th>@lang('bt.client')</th>
        <th>@lang('bt.summary')</th>
        <th>@lang('bt.next_date')</th>
        <th>@lang('bt.stop_date')</th>
        <th>@lang('bt.every')</th>
        <th style="text-align: right; padding-right: 25px;">@lang('bt.total')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($recurringInvoices as $recurringInvoice)
        <tr>
            <td>
                <a href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}" title="@lang('bt.edit')">{{ $recurringInvoice->id }}</a>
            </td>
            <td>
                <a href="{{ route('clients.show', [$recurringInvoice->client->id]) }}" title="@lang('bt.view_client')">{{ $recurringInvoice->client->unique_name }}</a>
            </td>
            <td>{{ mb_strimwidth($recurringInvoice->summary,0,100,'...') }}</td>
            <td>{{ $recurringInvoice->formatted_next_date }}</td>
            <td>{{ $recurringInvoice->formatted_stop_date }}</td>
            <td>{{ $recurringInvoice->recurring_frequency . ' ' . $frequencies[$recurringInvoice->recurring_period] }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $recurringInvoice->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}"><i
                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                        <a class="dropdown-item" href="{{ route('recurringInvoices.delete', [$recurringInvoice->id]) }}"
                               onclick="return confirm('@lang('bt.trash_record_warning')');"><i
                                    class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
