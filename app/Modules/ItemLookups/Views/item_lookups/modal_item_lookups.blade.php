@include('item_lookups._js_modal_item_lookups')

<div class="modal fade" id="modal-choose-items">
    <div class="modal-dialog mw-100">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.add_lookup')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('bt.item')</th>
                        <th>@lang('bt.description')</th>
                        <th>@lang('bt.price')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item_lookups as $item_lookup)
                    <tr>
                    <td><input type="checkbox" name="item_lookup_ids[]" value="{!! $item_lookup->id!!}"></td>
                        <td>{!!  $item_lookup->formatted_name !!}</td>
                        <td>{!!  $item_lookup->description !!}</td>
                        <td>{!!  $item_lookup->formatted_price !!}</td>
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
