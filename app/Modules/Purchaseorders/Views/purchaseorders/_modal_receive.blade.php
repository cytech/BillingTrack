
{{--@include('layouts._typeahead')--}}
{{--@include('vendors._js_lookup')--}}
@include('purchaseorders._js_receive')

<div class="modal fade" id="receive-purchaseorder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.receive_purchaseorder')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>
                <form>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                <div class="table-responsive">
                    <table class="table items-list">
                        <thead>
                        <tr>
{{--                            <th> </th>--}}
                            <th>Status</th>
                            <th>Item</th>
                            <th>Ordered Qty</th>
                            <th>Ordered Cost</th>
                            <th>Received Qty</th>
                            <th>Received Cost</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
{{--                                <td>{{ Form::checkbox('itemrec_ids[]',$item->id) }}</td>--}}
                                <input type="hidden" name="id" value="{!! $item->id !!}" >
                                <td><span class="badge badge-{{ $item->status_text }}"> {!! ucfirst($item->status_text) !!}</span></td>
                                <td>{!! $item->name !!}</td>
                                <td>{!! $item->quantity !!}</td>
                                <td>{!! $item->cost !!}</td>
                                <td>{!! Form::text('rec_qty', $item->quantity - $item->rec_qty, ['id' => 'rec_qty', 'class' => 'form-control']) !!}</td>
                                <td>{!! Form::text('rec_cost', $item->cost, ['id' => 'rec_cost', 'class' => 'form-control']) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ Form::label('itemrec', trans('bt.update_products')) }}
                    {{ Form::checkbox('itemrec', 1, config('bt.updateProductsDefault', ['id' => 'itemrec', 'class' => 'checkbox'])) }}
                </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="purchaseorder-receive-confirm" class="btn btn-primary">@lang('bt.submit')
                </button>
            </div>
        </div>
    </div>
</div>
