<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('products.edit', [$id]) }}"><i
                    class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a href ="javascript:void(0)" class="create-purchaseorder dropdown-item" data-name="{{ $model->vendor->name ?? '' }}"
           data-productid="{{ $id }}"><i class="fa fa-shopping-cart"></i> @lang('bt.order')</a>
    </div>
</div>
