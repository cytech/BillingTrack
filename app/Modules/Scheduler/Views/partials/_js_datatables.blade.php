<script type="text/javascript" language="javascript" class="init">
$(function () {

    {{--For dashboard DT --}}
    $('#dt-reminderstable').DataTable({
        order: [[2, "asc"]],//order on start_time
        "columnDefs": [
            {"orderable": false, "targets": 4}
        ]
    });
});
</script>
