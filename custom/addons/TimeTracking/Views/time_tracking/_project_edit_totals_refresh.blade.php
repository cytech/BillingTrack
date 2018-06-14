<script type="text/javascript">
function refreshTotals() {
    $('#div-totals').load('{{ route('timeTracking.projects.refreshTotals') }}', {
        project_id: {{ $project->id }}
    });
}
</script>