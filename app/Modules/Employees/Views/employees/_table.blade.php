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
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->short_name }}</td>
            <td>{{ $employee->title }}</td>
            <td>{{ $employee->schedule }}</td>
            <td>{{ $employee->active }}</td>
            <td>{{ $employee->driver }}</td>
            <td> <a href="{{ route('employees.edit', [$employee->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-user-edit"></i>
                    {{ trans('fi.edit') }} </a></td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for employees DT--}}
        $('#dt-employeestable').DataTable({
            paging: false,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 8}
            ]
        });
    });
</script>
