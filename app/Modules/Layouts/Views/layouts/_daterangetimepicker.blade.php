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
                @if (config('bt.use24HourTimeFormat'))
                timePicker24Hour: true,
                @endif
                locale: {
                    @if (config('bt.use24HourTimeFormat'))
                    format: "{{ strtoupper(config('bt.datepickerFormat')) }} H:mm",
                    @else
                    format: "{{ strtoupper(config('bt.datepickerFormat')) }} h:mm A",
                    @endif
                    customRangeLabel: "@lang('bt.custom')",
                    daysOfWeek: [
                        "@lang('bt.day_short_sunday')",
                        "@lang('bt.day_short_monday')",
                        "@lang('bt.day_short_tuesday')",
                        "@lang('bt.day_short_wednesday')",
                        "@lang('bt.day_short_thursday')",
                        "@lang('bt.day_short_friday')",
                        "@lang('bt.day_short_saturday')"
                    ],
                    monthNames: [
                        "@lang('bt.month_january')",
                        "@lang('bt.month_february')",
                        "@lang('bt.month_march')",
                        "@lang('bt.month_april')",
                        "@lang('bt.month_may')",
                        "@lang('bt.month_june')",
                        "@lang('bt.month_july')",
                        "@lang('bt.month_august')",
                        "@lang('bt.month_september')",
                        "@lang('bt.month_october')",
                        "@lang('bt.month_november')",
                        "@lang('bt.month_december')"
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
