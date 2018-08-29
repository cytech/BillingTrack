<div id= "rangefilter" style="display: none;" class="col-lg-6 col-lg-offset-1">
    <label>Job Date Range Filter From </label>
    {!! Form::text('rangestart', null, ['id' =>'rangestart', 'class' => '']) !!}
    <label> To </label>
    {!! Form::text('rangeend', null, ['id' =>'rangeend', 'class' => '']) !!}
    {{--<button id="filter" class="button radius" >Filter</button>--}}
    <button id="clearFilter" class="button radius secondary">Clear Filter</button>
</div>

<script type="text/javascript" language="javascript" class="init">
$(function () {
    {{--for employees DT--}}
    $('#dt-employeestable').DataTable({
        paging: false,
        order: [[0, "asc"]],//order on id
        "columnDefs": [
            {"orderable": false, "targets": 8}
        ]
    });
    {{--for resources DT--}}
    $('#dt-resourcestable').DataTable({
        paging: false,
        order: [[0, "asc"]],//order on id
        "columnDefs": [
            {"orderable": false, "targets": 7}
        ]
    });
    {{--for timesheet table DT--}}
    $('#dt-timesheetstable').DataTable({
        paging: false,
        searching: false,
        order: [[5, "asc"]]//order on fullname
    });
   {{--for workorders table DT--}}
     var oTable = $('#dt-workordertable').DataTable({
        order: [[4, "desc"]],//order on job_date Desc
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columnDefs": [
            {"orderable": false, "targets": [0, 1, 8, 9]}
        ],
        dom: '<"top"l<"toolbar">f>rt<"bottom"ip><"clear">',
        rowId: 'id',
        initComplete: function(){
            $('div.toolbar').html($('#rangefilter').show());
        }
    });

        {{--for trash table DT--}}
        var oTable2 = $('#dt-trashtable').DataTable({
        order: [[4, "desc"]],//order on job_date Desc
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columnDefs": [
            {"orderable": false, "targets": 5}
        ],
        dom: '<"top"l<"toolbar">f>rt<"bottom"ip><"clear">',
        initComplete: function () {
            $('div.toolbar').html($('#rangefilter').show());
        }
    });

    $('#clearFilter').on('click', function(){
        $('#rangestart, #rangeend').datepicker('setDate', null);
        minDateFilter = null;
        maxDateFilter = null;
        oTable.draw();
        oTable2.draw();
    });

    $("#rangestart").datepicker({
        dateFormat: "yy-mm-dd",
        "onSelect": function(date) {
            minDateFilter = new Date(date).getTime();
            oTable.draw();
            oTable2.draw();
        }
    }).keyup(function() {
        minDateFilter = new Date(this.value).getTime();
        oTable.draw();
        oTable2.draw();
    });

    $("#rangeend").datepicker({
        dateFormat: "yy-mm-dd",
        "onSelect": function(date) {
            maxDateFilter = new Date(date).getTime();
            oTable.draw();
            oTable2.draw();
        }
    }).keyup(function() {
        maxDateFilter = new Date(this.value).getTime();
        oTable.draw();
        oTable2.draw();
    });

    {{--For dashboard DT--}}
    $('#dt-reminderstable').DataTable({
        order: [[1, "asc"]],//order on start_time
        "columnDefs": [
            {"orderable": false, "targets": 4}
        ]
    });
});

// Date range filter for workorder table column 4, job_date
minDateFilter = "";
maxDateFilter = "";
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        if (typeof data._date === 'undefined') {
            data._date = new Date(data[4]).getTime();
        }
        if (minDateFilter && !isNaN(minDateFilter)) {
            if (data._date < minDateFilter) {
                return false;
            }
        }
        if (maxDateFilter && !isNaN(maxDateFilter)) {
            if (data._date > maxDateFilter) {
                return false;
            }
        }
        return true;
    }
);

</script>
