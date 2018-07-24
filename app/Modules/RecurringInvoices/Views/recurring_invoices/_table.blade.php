<table class="table table-hover">

    <thead>
    <tr>
        <th>{{ trans('fi.id') }}</th>
        <th>{{ trans('fi.client') }}</th>
        <th class="hidden-sm hidden-xs">{{ trans('fi.summary') }}</th>
        <th>{{ trans('fi.next_date') }}</th>
        <th>{{ trans('fi.stop_date') }}</th>
        <th>{{ trans('fi.every') }}</th>
        <th style="text-align: right; padding-right: 25px;">{{ trans('fi.total') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($recurringInvoices as $recurringInvoice)
        <tr>
            <td>
                <a href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}" title="{{ trans('fi.edit') }}">{{ $recurringInvoice->id }}</a>
            </td>
            <td>
                <a href="{{ route('clients.show', [$recurringInvoice->client->id]) }}" title="{{ trans('fi.view_client') }}">{{ $recurringInvoice->client->unique_name }}</a>
            </td>
            <td class="hidden-sm hidden-xs">{{ $recurringInvoice->summary }}</td>
            <td>{{ $recurringInvoice->formatted_next_date }}</td>
            <td>{{ $recurringInvoice->formatted_stop_date }}</td>
            <td>{{ $recurringInvoice->recurring_frequency . ' ' . $frequencies[$recurringInvoice->recurring_period] }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $recurringInvoice->amount->formatted_total }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('recurringInvoices.edit', [$recurringInvoice->id]) }}"><i
                                    class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
                        <li><a href="{{ route('recurringInvoices.delete', [$recurringInvoice->id]) }}"
                               onclick="return confirm('{{ trans('fi.trash_record_warning') }}');"><i
                                    class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>