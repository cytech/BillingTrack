    <table id="dt-productstable" class="table dataTable no-footer" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>@lang('bt.product_id')</th>
        <th>@lang('bt.product_name')</th>
        <th>@lang('bt.price_sales')</th>
        <th>@lang('bt.vendor')</th>
        <th>@lang('bt.product_cost')</th>
        <th>@lang('bt.product_category')</th>
        <th>@lang('bt.product_type')</th>
        <th>@lang('bt.product_numstock')</th>
        <th>@lang('bt.product_active')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($products as $product)
        <tr>
            <td><a href="{{ route('products.edit', [$product->id]) }}"
                   title="@lang('bt.edit')">{{ $product->id }}</a></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ (!empty($product->vendor->name)) ? $product->vendor->name :'' }}</td>
            <td>{{ $product->cost }}</td>
            <td>{{ (!empty($product->category->name)) ? $product->category->name : '' }}</td>
            <td>{{ $product->inventorytype->name }}</td>
            <td>{{ $product->numstock }}</td>
            <td>{{ $product->active }}</td>
            <td>
            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                @lang('bt.options')
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="{{ route('products.edit', [$product->id]) }}"><i
                            class="fa fa-edit"></i> @lang('bt.edit')</a>
                <a href ="javascript:void(0)" class="create-purchaseorder dropdown-item" data-name="{{ (($product->vendor->name) ? $product->vendor->name : '') }}"
                   data-productid="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> @lang('bt.order')</a>
            </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

<script>
    $(function () {
        {{--for products DT--}}
        $('#dt-productstable').DataTable({
            paging: true,
            order: [[0, "asc"]],//order on id
            "columnDefs": [
                {"orderable": false, "targets": 9}
            ]
        });
    });
</script>
