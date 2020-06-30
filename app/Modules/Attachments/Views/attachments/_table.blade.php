<script type="text/javascript">
    $(function () {
        $('.btn-delete-attachment').click(function () {

            Swal.fire({
                title: '@lang('bt.trash_record_warning')',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d68500',
                confirmButtonText: '@lang('bt.yes_sure')'
            }).then((result) => {
                if (result.value) {
                    $.post("{{ route('attachments.ajax.delete') }}", {
                        model: '{{ addslashes($model) }}',
                        model_id: '{{ $object->id }}',
                        attachment_id: $(this).data('attachment-id')
                    }).done(function () {
                        $('#attachments-list').load("{{ route('attachments.ajax.list') }}", {
                            model: '{{ addslashes($model) }}',
                            model_id: '{{ $object->id }}'
                        });
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
        });

        $('.client-visibility').change(function () {
            $.post('{{ route('attachments.ajax.access.update') }}', {
                client_visibility: $(this).val(),
                attachment_id: $(this).data('attachment-id')
            });
        });

        $('#btn-attach-files').click(function () {
            $('#modal-placeholder').load('{{ route('attachments.ajax.modal') }}', {
                model: '{{ addslashes($model) }}',
                model_id: '{{ $object->id }}'
            });
        });
    });
</script>

<div id="attachments-list">

    @if (!config('app.demo'))
        <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btn-attach-files">@lang('bt.attach_files')</a>
    @else
        <a href="javascript:void(0)" class="btn btn-primary btn-sm">File attachments are disabled in the demo</a>
    @endif

    <table class="table table-sm">
        <thead>
        <tr>
            <th>@lang('bt.attachment')</th>
            <th>@lang('bt.client_visibility')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($object->attachments()->orderBy('created_at', 'desc')->get() as $attachment)
            <tr>
                <td><a href="{{ $attachment->download_url }}">{{ $attachment->filename }}</a></td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::select('', $object->attachment_permission_options, $attachment->client_visibility, ['class' => 'form-control client-visibility', 'data-attachment-id' => $attachment->id]) !!}
                        </div>
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm btn-secondary btn-delete-attachment" href="javascript:void(0);"
                       title="@lang('bt.trash')" data-attachment-id="{{ $attachment->id }}">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
