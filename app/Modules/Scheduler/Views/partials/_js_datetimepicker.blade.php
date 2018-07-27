<script>
    $(document).ready(function () {
        $(".from").datetimepicker({
            format: 'Y-m-d H:i',
            defaultDate: new Date(),
            defaultTime: '08:00',
            step: {!! config('fi.schedulerTimestep') !!},
            onClose: function (selectedDate) {
                $(".to").datetimepicker({minDate: selectedDate});
            }
        });
        $(".to").datetimepicker({
            format: 'Y-m-d H:i',
            defaultDate: new Date(),
            defaultTime: '16:00',
            step: {!! config('fi.schedulerTimestep') !!},
            onClose: function (selectedDate) {
                $(".from").datetimepicker({maxDate: selectedDate});
            }
        });
        $(".until").datetimepicker({
            format: 'Y-m-d H:i',
            defaultDate: '+1970/02/01',//+1 month
            defaultTime: '16:00',
            step: {!! config('fi.schedulerTimestep') !!},
        });
    });
</script>