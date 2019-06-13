<script type="text/javascript">
    $(function () {
        $('#btn-create-contact-note').click(function () {
            if ($('#note_content_contact').val() !== '') {
                @if (isset($showPrivateCheckbox) and $showPrivateCheckbox == true)
                    showPrivateCheckbox = 1;
                if ($('#private').prop('checked')) {
                    isPrivate = 1;
                }
                else {
                    isPrivate = 0;
                }
                @else
                    showPrivateCheckbox = 0;
                isPrivate = 0;
                @endif
                $.post('{{ route('notes.create') }}', {
                    model: '{{ addslashes($model) }}',
                    model_id: {{ $object->id }},
                    note: $('#note_content_contact').val(),
                    isPrivate: isPrivate,
                    showPrivateCheckbox: showPrivateCheckbox
                }).done(function (response) {
                    $('#note_content_contact').val('');
                    $('#private').prop('checked', false);
                    $('#notes-list-contact').html(response);
                });
            }
        });

        @if (!auth()->user()->client_id)
        $(document).on('click', '.delete-note', function () {
            noteId = $(this).data('note-id');
            $('#note-' + noteId).hide();
            $.post("{{ route('notes.delete') }}", {
                id: noteId
            });
        });
        @endif
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-solid direct-chat direct-chat-warning">
            @if (!isset($hideHeader))
                <div class="card-header">
                    <h3 class="card-title">@lang('bt.notes')</h3>
                </div>
            @endif
            <div class="card-body">
                <div class="direct-chat-messages" id="notes-list-contact">
                    @include('notes._notes_list')
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12">
                        @if (isset($showPrivateCheckbox) and $showPrivateCheckbox == true)
                            <label>
                                <input type="checkbox" name="private" id="private"> @lang('bt.private')
                            </label>
                        @endif
                        <textarea placeholder="@lang('bt.placeholder_type_message')"
                                  class="form-control"
                                  id="note_content_contact"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-flat btn-block"
                                id="btn-create-contact-note">@lang('bt.add_note')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
