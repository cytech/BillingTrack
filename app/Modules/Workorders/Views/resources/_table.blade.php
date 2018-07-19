    <table id="dt-resourcestable" class="display" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('Workorders::texts.resource_id') !!}</th>
        <th>{!! trans('Workorders::texts.resource_name') !!}</th>
        <th>{!! trans('Workorders::texts.resource_active') !!}</th>
        <th>{!! trans('Workorders::texts.resource_cost') !!}</th>
        <th>{!! trans('Workorders::texts.resource_category') !!}</th>
        <th>{!! trans('Workorders::texts.resource_type') !!}</th>
        <th>{!! trans('Workorders::texts.resource_numstock') !!}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($resources as $resource)
        <tr>
            <td><a href="{{ route('resources.edit', [$resource->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $resource->id }}</a></td>
            <td class="hidden-xs">{{ $resource->name }}</td>
            <td class="hidden-sm hidden-xs">{{ $resource->active }}</td>
            <td class="hidden-sm hidden-xs">{{ $resource->cost }}</td>
            <td class="hidden-sm hidden-xs">{{ $resource->category }}</td>
            <td class="hidden-sm hidden-xs">{{ $resource->type }}</td>
            <td class="hidden-sm hidden-xs">{{ $resource->numstock }}</td>
            <td> <a href="{{ route('resources.edit', [$resource->id]) }}" class="btn btn-primary btn-sm ">
                    {{ trans('fi.edit') }} </a></td>
        </tr>
    @endforeach
    </tbody>

</table>
{{--@include('Workorders::partials._js_datatables')--}}