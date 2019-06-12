    <table id="dt-vendorstable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>@lang('fi.id')</th>
        <th>@lang('fi.name')</th>
        <th>@lang('fi.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($vendors as $vendor)
        <tr>
            <td><a href="{{ route('vendors.edit', [$vendor->id]) }}"
                   title="@lang('fi.edit')">{{ $vendor->id }}</a></td>
            <td>{{ $vendor->name }}</td>
            <td> <a href="{{ route('vendors.edit', [$vendor->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-edit"></i>
                    @lang('fi.edit') </a></td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for vendors DT--}}
        $('#dt-vendorstable').DataTable({
            paging: false,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 2}
            ]
        });
    });
</script>
