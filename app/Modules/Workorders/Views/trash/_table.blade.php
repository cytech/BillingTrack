<table id="dt-trashtable" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>
        <th>{{ trans('Workorders::texts.customer') }}</th>
        <th>{{ trans('Workorders::texts.workorder_number') }}</th>
        <th>{{ trans('Workorders::texts.workorder_summary') }}</th>
        <th>{{ trans('Workorders::texts.job_date') }}</th>
        <th>{{ trans('Workorders::texts.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr id="{!! $event->id !!}">
            <td><input type="checkbox" class="bulk-record" data-id="{{ $event->id }}"></td>
            @if(empty( $event->client->name))
                <td>{{ trans('Workorders::texts.no_client_warning') }}</td>
            @else
                <td>{!! $event->client->name !!}</td>
            @endif
            <td>{!! $event->number !!}</td>
            <td>{!! $event->summary !!}</td>
            <td>{!! DateTime::createFromFormat('Y-m-d H:i:s',$event->job_date)->format('Y-m-d') !!}</td>
            <td>
                <a class="btn btn-success delete" ng-click="restore({!! $event->id !!})"><i
                            class="fa fa-fw fa-reply"></i>{{ trans('Workorders::texts.restore') }}</a>
                <a class="btn btn-danger delete" ng-click="delete({!! $event->id !!})"><i
                            class="fa fa-fw fa-trash-o"></i>{{ trans('Workorders::texts.delete') }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
