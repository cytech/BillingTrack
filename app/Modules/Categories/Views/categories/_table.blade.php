    <table id="dt-categoriestable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>@lang('fi.id')</th>
        <th>@lang('fi.name')</th>
        <th>@lang('fi.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($categories as $category)
        <tr>
            <td><a href="{{ route('categories.edit', [$category->id]) }}"
                   title="@lang('fi.edit')">{{ $category->id }}</a></td>
            <td>{{ $category->name }}</td>
            <td> <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-edit"></i>
                    @lang('fi.edit') </a></td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for categories DT--}}
        $('#dt-categoriestable').DataTable({
            paging: false,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 2}
            ]
        });
    });
</script>
