<div id= "rangefilter" style="display: none;" class="col-lg-6 col-lg-offset-1">
    <label>Start Date Range Filter From </label>
    {!! Form::text('rangestart', null, ['id' =>'rangestart', 'style'=>'width:25%','class' => '']) !!}
    <label> To </label>
    {!! Form::text('rangeend', null, ['id' =>'rangeend', 'style'=>'width:25%','class' => '']) !!}
    {{--<button id="filter" class="button radius" >Filter</button>--}}
    <button id="clearFilter" class="button radius secondary">Clear Filter</button>
</div>

<script type="text/javascript" language="javascript" class="init">
$(function () {

    {{--For dashboard DT --}}
    $('#dt-reminderstable').DataTable({
        order: [[2, "asc"]],//order on start_time
        "columnDefs": [
            {"orderable": false, "targets": 4}
        ]
    });

    {{--For categories DT--}}
    $('#dt-categoriestable').DataTable({
        order: [[0, "asc"]],//order on start_time
        "columnDefs": [
            {"orderable": false, "targets": 4}
        ]
    });
   {{--for trash, event, recurring event tables DT--}}
     var oTable = $('#dt-filtertable').DataTable({
        order: [[3, "desc"]],//order on job_date Desc
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columnDefs": [
            {"orderable": false, "targets": 6}
        ],
        dom: '<"top"l<"toolbar">f>rt<"bottom"ip><"clear">',
        rowId: 'id',
        initComplete: function(){
            $('div.toolbar').html($('#rangefilter').show());
        }
    });

    $('#clearFilter').on('click', function(){
        $('#rangestart, #rangeend').datetimepicker('reset');
        minDateFilter = null;
        maxDateFilter = null;
        oTable.draw();
    });

    $("#rangestart").datetimepicker({
        //dateFormat: "yy-mm-dd",
        format: 'Y-m-d H:i',
        defaultTime: '00:00',
        onChangeDateTime: function(date) {
            minDateFilter = new Date(date).getTime();
            oTable.draw();
        }
    }).keyup(function() {
        minDateFilter = new Date(this.value).getTime();
        oTable.draw();
    });
    console.log(minDateFilter);

    $("#rangeend").datetimepicker({
        //dateFormat: "yy-mm-dd",
        format: 'Y-m-d H:i',
        allowTimes:[ '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00',
            '09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00',
            '18:00','19:00','20:00','21:00','22:00','23:00','23:59' ],
        defaultTime: '23:59',
        onChangeDateTime: function(date) {
            maxDateFilter = new Date(date).getTime();
            oTable.draw();
        }
    }).keyup(function() {
        maxDateFilter = new Date(this.value).getTime();
        oTable.draw();
    });
});

// Date range filter for workorder table column 4, job_date
minDateFilter = "";
maxDateFilter = "";
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        if (typeof data._date === 'undefined') {
            data._date = new Date(data[3]).getTime();
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
