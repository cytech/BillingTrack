<script src='{{ asset('plugins/moment/moment.min.js') }}'></script>
<script src='{{ asset('plugins/daterangepicker/daterangepicker.js') }}'></script>
<link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>

<script type="text/javascript">
    $(function () {
        const sentStart = $('#from_date').val();
        const sentEnd = $('#to_date').val();
        const startDate = (sentStart === '' ? moment().startOf('month') : moment(sentStart));
        const endDate = (sentEnd === '' ? moment().endOf('month') : moment(sentEnd));
        $('#date_range').daterangepicker({
                autoApply: true,
                startDate: startDate,
                endDate: endDate,
                locale: {
                    format: "{{ strtoupper(config('fi.datepickerFormat')) }}",
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
                },
                ranges: {
                    '@lang('fi.today')': [moment(), moment()],
                    '@lang('fi.yesterday')': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '@lang('fi.tomorrow')': [moment().add(1, 'days'), moment().add(1, 'days')],
                    '@lang('fi.lastweek')': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
                    '@lang('fi.twoweeksago')': [moment().subtract(2, 'weeks').startOf('isoWeek'), moment().subtract(2, 'weeks').endOf('isoWeek')],
                    '@lang('fi.last_7_days')': [moment().subtract(6, 'days'), moment()],
                    '@lang('fi.last_30_days')': [moment().subtract(29, 'days'), moment()],
                    '@lang('fi.this_month')': [moment().startOf('month'), moment().endOf('month')],
                    '@lang('fi.last_month')': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '@lang('fi.this_year')': [moment().startOf('year'), moment().endOf('year')],
                    '@lang('fi.last_year')': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    '@lang('fi.this_quarter')': [moment().startOf('quarter'), moment().endOf('quarter')],
                    '@lang('fi.last_quarter')': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
                    '@lang('fi.first_quarter')': [moment().startOf('quarter').quarter(1), moment().endOf('quarter').quarter(1)],
                    '@lang('fi.second_quarter')': [moment().startOf('quarter').quarter(2), moment().endOf('quarter').quarter(2)],
                    '@lang('fi.third_quarter')': [moment().startOf('quarter').quarter(3), moment().endOf('quarter').quarter(3)],
                    '@lang('fi.fourth_quarter')': [moment().startOf('quarter').quarter(4), moment().endOf('quarter').quarter(4)]
                }
            },
            function (start, end) {
                daterangepicker_update_fields(start, end);
            });

        function daterangepicker_update_fields(start, end) {
            $('#from_date').val(start.format('YYYY-MM-DD'));
            $('#to_date').val(end.format('YYYY-MM-DD'));
        }

        daterangepicker_update_fields(startDate, endDate);
    });
</script>