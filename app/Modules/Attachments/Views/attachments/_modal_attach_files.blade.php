@if (!config('app.demo'))
    <script type="text/javascript">

        $(function () {
            $('#modal-attach-files').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#input-attachments').change(function () {

                formData = new FormData(document.forms.namedItem('form-attachments'));
                formData.append('model', '{{ addslashes($model) }}');
                formData.append('model_id', '{{ $modelId }}');

                $('#input-attachments').attr('disabled', 'disabled');
                resetProgressBar('0%', '0%');
                $('#attachment-upload-progress').show();

                $.ajax({
                    url: '{{ route('attachments.ajax.upload') }}',
                    type: 'POST',
                    data: formData,
                    xhr: function () {
                        const myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', progress, false);
                        }
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data, textStatus, jqXHR) {
                        $('#input-attachments').val('');
                        $('#attachments-list').load("{{ route('attachments.ajax.list') }}", {
                            model: '{{ addslashes($model) }}',
                            model_id: '{{ $modelId }}'
                        });
                        $('#input-attachments').removeAttr('disabled');
                        $('#modal-attach-files').modal('hide');
                    },
                    error: function (XMLHttpRequest, textStatus, error) {
                        $("#attachment-upload-progress-bar").addClass('bg-danger').html(error);
                        $('#input-attachments').removeAttr('disabled');
                    }
                });

            });

            function progress(e) {
                if (e.lengthComputable) {
                    const max = e.total;
                    const current = e.loaded;
                    const Percentage = Math.round((current * 100) / max);
                    $("#attachment-upload-progress-bar").css("width", Percentage + '%').html(Percentage + '%');

                    if (Percentage == 100) {
                        resetProgressBar('100%', '@lang('bt.complete')');
                        $('#attachment-upload-progress-bar').addClass('bg-success').html('@lang('bt.complete')');
                    }
                }
            }

            function resetProgressBar(width, text) {
                $('#attachment-upload-progress-bar')
                    .removeClass('bg-danger')
                    .removeClass('bg-success')
                    .css('width', width)
                    .html(text);
            }

        });
    </script>

    <div class="modal fade" id="modal-attach-files">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('bt.attach_files')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <p class="text-bold">@lang('bt.attach_files')</p>
                    <form method="post" enctype="multipart/form-data" name="form-attachments" id="form-attachments" style="margin-bottom: 10px;">
                        <input type="file" name="attachments[]" id="input-attachments" multiple>
                    </form>

                    <div style="display: none;" id="attachment-upload-progress">
                        <p class="text-bold">@lang('bt.upload_progress')</p>

                        <div class="progress">
                            <div id="attachment-upload-progress-bar" class="progress-bar" role="progressbar" style="width: 0;">
                                0%
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                </div>
            </div>
        </div>
    </div>
@endif
