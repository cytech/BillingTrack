<table class="table table-hover" style="height: 100%;">

    <thead>
    <tr>
        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
        <th class="hidden-sm hidden-xs">{{ trans('fi.status') }}</th>
        <th>{{ trans('fi.workorder') }}</th>
        <th class="hidden-xs">{{ trans('fi.date') }}</th>
        <th>{{ trans('fi.job_date') }}</th>
        <th>{{ trans('fi.client_name') }}</th>
        <th class="hidden-sm hidden-xs">{{ trans('fi.summary') }}</th>
        <th style="text-align: right; padding-right: 25px;">{{ trans('fi.total') }}</th>
        <th>{{ trans('fi.invoiced') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($workorders as $workorder)
        <tr id="{!! $workorder->id !!}">
            <td><input type="checkbox" class="bulk-record" data-id="{{ $workorder->id }}"></td>
            <td class="hidden-sm hidden-xs">
                <span class="label label-{{ $statuses[$workorder->workorder_status_id] }}">{{ trans('fi.' . $statuses[$workorder->workorder_status_id]) }}</span>
                @if ($workorder->viewed)
                    <span class="label label-success">{{ trans('fi.viewed') }}</span>
                @else
                    <span class="label label-default">{{ trans('fi.not_viewed') }}</span>
                @endif
            </td>
            <td><a href="{{ route('workorders.edit', [$workorder->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $workorder->number }}</a></td>
            <td class="hidden-xs">{{ DateTime::createFromFormat('Y-m-d H:i:s',$workorder->workorder_date)->format('Y-m-d') }}</td>
            <td class="hidden-sm hidden-xs">{{ DateTime::createFromFormat('Y-m-d H:i:s',$workorder->job_date)->format('Y-m-d') }}</td>
            <td><a href="{{ route('clients.show', [$workorder->client->id]) }}"
                   title="{{ trans('fi.view_client') }}">{{ $workorder->client->unique_name }}</a></td>
            <td class="hidden-sm hidden-xs">{{ mb_strimwidth($workorder->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $workorder->amount->formatted_total }}</td>
            <td class="hidden-xs">
                @if ($workorder->invoice)
                    <a href="{{ route('invoices.edit', [$workorder->invoice_id]) }}">{{ trans('fi.yes') }}</a>
                @else
                    {{ trans('fi.no') }}
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        {{ trans('fi.options') }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('workorders.edit', [$workorder->id]) }}"><i
                                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
                        <li><a href="{{ route('workorders.pdf', [$workorder->id]) }}" target="_blank" id="btn-pdf-workorder"><i
                                        class="fa fa-print"></i> {{ trans('fi.pdf') }}</a></li>
                        <li><a href="#"
                               onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}','{{ route('workorders.delete', [$workorder->id]) }}');"><i
                                        class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
