@include('products._js_modal_products')

<div class="modal fade" id="modal-choose-items">
    <div class="modal-dialog mw-100">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.add_product')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            @if($vname)
            <div class="modal-header">
                <label>
                    <input type="checkbox" checked name="pref_vendor" id="pref_vendor"> @lang('bt.vendor_preferred_only', ['vname' => $vname])
                </label>
            </div>
            @endif
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <table class="table table-bordered table-striped" id="product-table">
                    <thead>
                    <tr class="prodheader">
                        <th></th>
                        <th>@lang('bt.name')</th>
                        <th>@lang('bt.description')</th>
                        <th>@lang('bt.product_cost')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                    <tr class="prodlist" data-vendor_id = "{!!  $product->vendor_id !!}" data-purch_vendor_id = "{!!  $vendorId !!}">
                    <td><input type="checkbox" name="product_ids[]" value="{!! $product->id!!}"></td>
                        <td>{!!  $product->name !!}</td>
                        <td>{!!  $product->description !!}</td>
                        <td>{!!  $product->formatted_cost !!}</td>
                    </tr>
                    @endforeach
                    </tbody>

            </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="select-items-confirm"
                        class="btn btn-primary">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
