<table id="dt-employeestable" class="display" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('Workorders::texts.employee_number') !!}</th>
        <th>{!! trans('Workorders::texts.employee_first_name') !!}</th>
        <th>{!! trans('Workorders::texts.employee_last_name') !!}</th>
        <th>{!! trans('Workorders::texts.employee_short_name') !!}</th>
        <th>{!! trans('Workorders::texts.employee_title') !!}</th>
        <th>{!! trans('Workorders::texts.scheduleable') !!}</th>
        <th>{!! trans('Workorders::texts.employee_active') !!}</th>
        <th>{!! trans('Workorders::texts.employee_driver') !!}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($employees as $employee)
        <tr>
            <td><a href="{{ route('employees.edit', [$employee->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $employee->number }}</a></td>
            <td class="hidden-xs">{{ $employee->first_name }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->last_name }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->short_name }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->title }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->schedule }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->active }}</td>
            <td class="hidden-sm hidden-xs">{{ $employee->driver }}</td>
            <td> <a href="{{ route('employees.edit', [$employee->id]) }}" class="btn btn-primary btn-sm ">
                    {{ trans('fi.edit') }} </a></td>
        </tr>
    @endforeach
    </tbody>

</table>
{{--@include('Workorders::partials._js_datatables')--}}