    <table id="dt-categoriestable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>@lang('bt.id')</th>
        <th>@lang('bt.name')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td> <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-edit"></i>
                    @lang('bt.edit') </a></td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for categories DT--}}
        $('#dt-categoriestable').DataTable({
            paging: true,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 2}
            ]
        });
    });
</script>
