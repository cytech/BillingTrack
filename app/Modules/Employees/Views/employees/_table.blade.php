<table id="dt-employeestable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>@lang('bt.employee_number')</th>
        <th>@lang('bt.employee_first_name')</th>
        <th>@lang('bt.employee_last_name')</th>
        <th>@lang('bt.employee_short_name')</th>
        <th>@lang('bt.employee_title')</th>
        <th>@lang('bt.scheduleable')</th>
        <th>@lang('bt.employee_active')</th>
        <th>@lang('bt.employee_driver')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($employees as $employee)
        <tr>
            <td><a href="{{ route('employees.edit', [$employee->id]) }}"
                   title="@lang('bt.edit')">{{ $employee->number }}</a></td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->short_name }}</td>
            <td>{{ $employee->title }}</td>
            <td>{{ $employee->schedule }}</td>
            <td>{{ $employee->active }}</td>
            <td>{{ $employee->driver }}</td>
            <td> <a href="{{ route('employees.edit', [$employee->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-user-edit"></i>
                    @lang('bt.edit') </a></td>
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
