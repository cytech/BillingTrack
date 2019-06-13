@include('time_tracking._task_list_refresh_js')

<script type="text/javascript">
    $(function () {

        $('#modal-add-task').modal();

        $('#modal-add-task').on('shown.bs.modal', function () {
            $("#add_task_name").focus();
        });

        $('.btn-submit-task').click(function () {
            $('#modal-status-placeholder').html('');
            $.post('{{ route('timeTracking.tasks.store') }}', {
                time_tracking_project_id: {{ $project->id }},
                name: $('#add_task_name').val()
            }).done(function (response) {
                $('#add_task_name').val('').focus();
                refreshTaskList();
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });
</script>

<div class="modal fade" id="modal-add-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.add_task')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                    <div class="form-group">
                        <label class="col-form-label">@lang('bt.task'):</label>
                        {!! Form::text('name', null, ['id' => 'add_task_name', 'class' => 'form-control']) !!}
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" class="btn btn-primary btn-submit-task" id="btn-submit-task-add-another">@lang('bt.submit_and_add_another_task')</button>
                <button type="button" class="btn btn-primary btn-submit-task" data-dismiss="modal">@lang('bt.submit_and_close')</button>
            </div>
        </div>
    </div>
</div>
