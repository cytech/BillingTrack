<script src='{{ asset('plugins/moment/moment.min.js') }}'></script>
<script src='{{ asset('plugins/daterangepicker/daterangepicker.js') }}'></script>
<link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>

<script type="text/javascript">
    $(function () {
        const startDate = moment().startOf('day');
        const endDate = moment().startOf('day');

        $('#date_time_range').daterangepicker({
                timePicker: true,
                timePickerIncrement: 15,
                autoApply: true,
                startDate: startDate,
                endDate: endDate,
                @if (config('fi.use24HourTimeFormat'))
                timePicker24Hour: true,
                @endif
                locale: {
                    @if (config('fi.use24HourTimeFormat'))
                    format: "{{ strtoupper(config('fi.datepickerFormat')) }} H:mm",
                    @else
                    format: "{{ strtoupper(config('fi.datepickerFormat')) }} h:mm A",
                    @endif
                    customRangeLabel: "@lang('fi.custom')",
                    daysOfWeek: [
                        "@lang('fi.day_short_sunday')",
                        "@lang('fi.day_short_monday')",
                        "@lang('fi.day_short_tuesday')",
                        "@lang('fi.day_short_wednesday')",
                        "@lang('fi.day_short_thursday')",
                        "@lang('fi.day_short_friday')",
                        "@lang('fi.day_short_saturday')"
                    ],
                    monthNames: [
                        "@lang('fi.month_january')",
                        "@lang('fi.month_february')",
                        "@lang('fi.month_march')",
                        "@lang('fi.month_april')",
                        "@lang('fi.month_may')",
                        "@lang('fi.month_june')",
                        "@lang('fi.month_july')",
                        "@lang('fi.month_august')",
                        "@lang('fi.month_september')",
                        "@lang('fi.month_october')",
                        "@lang('fi.month_november')",
                        "@lang('fi.month_december')"
                    ],
                    firstDay: 1
                }
            },
            function (start, end) {
                daterangepicker_update_fields(start, end);
            });

        function daterangepicker_update_fields(start, end) {
            $('#from_date_time').val(start.format('YYYY-MM-DD H:mm:ss'));
            $('#to_date_time').val(end.format('YYYY-MM-DD H:mm:ss'));
        }

        daterangepicker_update_fields(startDate, endDate);

        $('.open-daterangetimepicker').click(function() {
            $('#date_time_range').click();
        });
    });
</script>