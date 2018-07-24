<script type="text/javascript">
    function refreshTaskList() {
        $('#project-task-list').load('{{ route('timeTracking.projects.refreshTaskList') }}', {
            project_id: {{ $project->id }}
        });
    }
</script>