@include('clients._js_subedit')

{!! Form::model($client, ['route' => ['clients.ajax.modalUpdate', $client->id], 'id' => 'form-edit-client']) !!}
<div class="modal" id="modal-edit-client">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.edit_client')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                @include('clients._form')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <input type="submit" id="btn-edit-client-submit" class="btn btn-primary" value="@lang('bt.save')">
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
