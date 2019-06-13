@include('time_tracking._task_list_refresh_js')

<script type="text/javascript">
    $(function() {
        $('#modal-edit-task').modal();

        $('#btn-submit-task').click(function() {
            $.post('{{ route('timeTracking.tasks.update') }}', {
                id: {{ $task->id }},
                time_tracking_project_id: {{ $task->time_tracking_project_id }},
                name: $('#edit_task_name').val()
            }).done(function (response) {
                $('#modal-edit-task').modal('hide');
                refreshTaskList();
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });
    })
</script>

<div class="modal fade" id="modal-edit-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.edit_task')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                    <div class="form-group">
                        <label class="col-form-label">@lang('bt.task'):</label>
                        {!! Form::text('name', $task->name, ['id' => 'edit_task_name', 'class' => 'form-control']) !!}
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" class="btn btn-primary" id="btn-submit-task">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
