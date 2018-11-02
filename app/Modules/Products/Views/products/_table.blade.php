    <table id="dt-productstable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('fi.product_id') !!}</th>
        <th>{!! trans('fi.product_name') !!}</th>
        <th>{!! trans('fi.product_active') !!}</th>
        <th>{!! trans('fi.product_cost') !!}</th>
        <th>{!! trans('fi.product_category') !!}</th>
        <th>{!! trans('fi.product_type') !!}</th>
        <th>{!! trans('fi.product_numstock') !!}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($products as $product)
        <tr>
            <td><a href="{{ route('products.edit', [$product->id]) }}"
                   title="{{ trans('fi.edit') }}">{{ $product->id }}</a></td>
            <td class="d-none d-sm-block">{{ $product->name }}</td>
            <td class="d-none d-md-block">{{ $product->active }}</td>
            <td class="d-none d-md-block">{{ $product->cost }}</td>
            <td class="d-none d-md-block">{{ $product->category }}</td>
            <td class="d-none d-md-block">{{ $product->type }}</td>
            <td class="d-none d-md-block">{{ $product->numstock }}</td>
            <td> <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-primary btn-sm "><i
                            class="fa fa-edit"></i>
                    {{ trans('fi.edit') }} </a></td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for products DT--}}
        $('#dt-productstable').DataTable({
            paging: false,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 7}
            ]
        });
    });
</script>