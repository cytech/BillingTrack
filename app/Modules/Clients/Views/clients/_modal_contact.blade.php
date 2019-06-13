<script type="text/javascript">
    $(function () {
        const modalContact = $('#modal-contact');

        modalContact.modal();

        $('#btn-contact-submit').click(function () {
            $.post("{{ $submitRoute }}", {
                client_id: {{ $clientId }},
                first_name: $('#contact_first_name').val(),
                last_name: $('#contact_last_name').val(),
                name: $('#contact_name').val(),
                title_id: $('#contact_title_id').val(),
                is_primary: $('#contact_is_primary').val(),
                optin: $('#contact_optin').val(),
                phone: $('#contact_phone').val(),
                fax: $('#contact_fax').val(),
                mobile: $('#contact_mobile').val(),
                email: $('#contact_email').val()
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            }).done(function (response) {
                modalContact.modal('hide');
                $('#tab-contacts').html(response);
            });
        });

    });
</script>

<div class="modal" id="modal-contact">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    @if ($editMode)
                        @lang('bt.edit_contact')
                    @else
                        @lang('bt.add_contact')
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('bt.first_name'):</label>
                                {!! Form::text('contact_first_name', ($editMode) ? $contact->first_name : null, ['class' => 'form-control', 'id' => 'contact_first_name']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('bt.last_name'):</label>
                                {!! Form::text('contact_last_name', ($editMode) ? $contact->last_name : null, ['class' => 'form-control', 'id' => 'contact_last_name']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <label>@lang('bt.name'):</label>
                                {!! Form::text('contact_name', ($editMode) ? $contact->name : null, ['class' => 'form-control', 'id' => 'contact_name']) !!}
                            </div>
                        </div>
                        <script>
                            $("#contact_last_name").on('change',function () {
                                let fullnameArray = [$("#contact_first_name").val(), $("#contact_last_name").val()];
                                if ( !$("#contact_name").val())
                                    $("#contact_name").val(fullnameArray.join(' '));
                            });
                        </script>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('bt.title'):</label>
                                {!! Form::select('contact_title_id', $titles, ($editMode) ? $contact->title_id : 1 , ['id' => 'contact_title_id', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('bt.is_primary'):</label>
                                {!! Form::select('contact_is_primary', ['0' => __('bt.no'), '1' => __('bt.yes')], ($editMode) ? $contact->is_primary : 0 , ['id' => 'contact_is_primary', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('bt.optin'):</label>
                                {!! Form::select('contact_optin', ['0' => __('bt.no'), '1' => __('bt.yes')], ($editMode) ? $contact->optin : 1, ['id' => 'contact_optin', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('bt.phone_number'): </label>
                                {!! Form::text('contact_phone', ($editMode) ? $contact->phone : null, ['id' => 'contact_phone', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('bt.fax_number'): </label>
                                {!! Form::text('contact_fax', ($editMode) ? $contact->fax : null, ['id' => 'contact_fax', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('bt.mobile_number'): </label>
                                {!! Form::text('contact_mobile', ($editMode) ? $contact->mobile : null, ['id' => 'contact_mobile', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('bt.email'):</label>
                                {!! Form::text('contact_email', ($editMode) ? $contact->email : null, ['class' => 'form-control', 'id' => 'contact_email']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if ($editMode)
                                @include('notes._notes_contact', ['object' => $contact, 'model' => 'BT\Modules\Clients\Models\Contact', 'hideHeader' => true])
                            @endif
                        </div>

                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> @lang('bt.cancel')</button>
                <button type="button" id="btn-contact-submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('bt.save')</button>
            </div>
        </div>
    </div>
</div>
