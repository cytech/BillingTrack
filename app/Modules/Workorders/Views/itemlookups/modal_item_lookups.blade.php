@include('Workorders::itemlookups._js_modal_item_lookups')

<div class="modal fade" id="modal-choose-items">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('Workorders::texts.add_lookup') }}</h4>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{!! trans('fi.item') !!}</th>
                        <th>{!! trans('fi.description') !!}</th>
                        <th>{!! trans('fi.price') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item_lookups as $item_lookup)
                    <tr>
                    <td><input type="checkbox" name="item_lookup_ids[]" value="{!! $item_lookup->id!!}"></td>
                    <td>{!!  $item_lookup->category == 'Driver' ? '<span style = "color:blue">'.$item_lookup->name.'</span>':$item_lookup->name !!}</td>
                        <td>{!!  $item_lookup->description !!}</td>
                        <td>{!!  $item_lookup->formatted_price !!}</td>
                    </tr>
                    @endforeach
                    </tbody>

            </table>

                <form class="form-horizontal">



                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="select-items-confirm"
                        class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>
