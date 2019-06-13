<style>
    .xdsoft_datetimepicker .xdsoft_timepicker {
        width: 75px;
        float: left;
        text-align: center;
        margin-left: 8px;
        margin-top: 0;
    }
</style>
<script>
    $(document).ready(function () {
        $(".from").datetimepicker({
            format: 'Y-m-d H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            defaultDate: new Date(),
            defaultTime: '08:00',
            step: {!! config('bt.schedulerTimestep') !!},
            onClose: function (selectedDate) {
                $(".to").datetimepicker({minDate: selectedDate});
            }
        });
        $(".to").datetimepicker({
            format: 'Y-m-d H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            defaultDate: new Date(),
            defaultTime: '16:00',
            step: {!! config('bt.schedulerTimestep') !!},
            onClose: function (selectedDate) {
                $(".from").datetimepicker({maxDate: selectedDate});
            }
        });
        $(".until").datetimepicker({
            format: 'Y-m-d H:i',
            formatTime: '{{ config('bt.use24HourTimeFormat') ? 'H:i' : 'g:i A' }}',
            defaultDate: '+1970/02/01',//+1 month
            defaultTime: '16:00',
            step: {!! config('bt.schedulerTimestep') !!},
        });
    });
</script>
