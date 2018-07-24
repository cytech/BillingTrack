<table id="dt-employeestable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('fi.employee_number') !!}</th>
        <th>{!! trans('fi.employee_first_name') !!}</th>
        <th>{!! trans('fi.employee_last_name') !!}</th>
        <th>{!! trans('fi.employee_short_name') !!}</th>
        <th>{!! trans('fi.employee_title') !!}</th>
        <th>{!! trans('fi.scheduleable') !!}</th>
        <th>{!! trans('fi.employee_active') !!}</th>
        <th>{!! trans('fi.employee_driver') !!}</th>
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
            <td> <a href="{{ route('employees.edit', [$employee->id]) }}" class="btn btn-default btn-sm ">
                    {{ trans('fi.edit') }} </a></td>
        </tr>
    @endforeach
    </tbody>

</table>
{{--@include('Workorders::partials._js_datatables')--}}
<script>
    $(function () {
        {{--for employees DT--}}
        $('#dt-employeestable').DataTable({
            paging: false,
            //searching: true,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 8}
            ]
            //dom: 'T<"clear">lfrtip'
        });
    });
</script>
