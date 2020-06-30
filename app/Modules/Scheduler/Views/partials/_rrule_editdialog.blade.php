<h3 class="offset-2">Set Recurrence</h3>
<br>
<div class="form-group">
    {!! Form::model($rrule) !!}
    <div class="form-group d-flex align-items-center">
        {!! Form::label('frequency',trans('bt.frequency_string'),['class'=>'col-sm-2 text-right text ']) !!}
        <div class="col-sm-6 ">
            {!! Form::text('frequency',null,['class'=>'form-control ','placeholder'=>'Frequency','readonly']) !!}
        </div>
    </div>
    <div class="form-group d-flex align-items-center">
        {!! Form::label('freqtext',trans('bt.frequency_text'),['class'=>'col-sm-2 text-right text']) !!}
        <div class="col-sm-6">
            {!! Form::text('freqtext',null,['class'=>'form-control','placeholder'=>'Frequency to Text','readonly']) !!}
        </div>
    </div>
    <div class="form-group d-flex align-items-center">
        {!! Form::label('Frequency',null,['for'=>'freq', 'class'=>'col-sm-2 text-right text','title'=> 'Frequency']) !!}
        <label class="btn btn-primary ">
            {!! Form::radio('freq','YEARLY',null,['id' => 'freq']) !!}<span> YEARLY</span></label>
        <label class="btn btn-primary">
            {!! Form::radio('freq','MONTHLY',null,['id' => 'freq']) !!}<span> MONTHLY</span></label>
        <label class="btn btn-primary">
            {!! Form::radio('freq','WEEKLY',null,['id' => 'freq']) !!}<span> WEEKLY</span></label>
        <label class="btn btn-primary">
            {!! Form::radio('freq','DAILY',null,['id' => 'freq']) !!}<span> DAILY</span></label>
        {{--{!! Form::radio('freq','HOURLY',false,['disabled' => 'true']) !!}{!! Form::label('HOURLY',null,['style'=>'margin-right: 10px']) !!}--}}
        {{--{!! Form::radio('freq','MINUTELY',false,['disabled' => 'true']) !!}{!! Form::label('MINUTELY',null,['style'=>'margin-right: 10px']) !!}--}}
        {{--{!! Form::radio('freq','SECONDLY',false,['disabled' => 'true']) !!}{!! Form::label('SECONDLY',null,['style'=>'margin-right: 10px']) !!}--}}
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Start DateTime',null,['for'=>'start_date', 'class'=>'col-sm-2 text-right text','title'=>
    'The recurrence start. Besides being the base for the recurrence, missing parameters in the final recurrence instances will also be extracted from this date. If not given, "new Date" will be used instead.'
    ]) !!}
    {{--<td><input name="start_date" type="datetime-local" value="{!! date('Y-m-d').'T08:00' !!}"/></td>--}}
    <div class="col-sm-2">
        {!! Form::input('text','start_date',null, ['id'=>'start_date','class'=>'form-control from','style'=>'cursor: pointer','readonly']) !!}
    </div>
    {!! Form::label('End DateTime',null,['for'=>'end_date', 'class'=>'col-sm-1 col-form-label','title'=>
    'The recurrence end. Besides being the base for the recurrence, missing parameters in the final recurrence instances will also be extracted from this date. If not given, "new Date" will be used instead.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','end_date',null, ['id'=>'end_date','class'=>'form-control to','style'=>'cursor: pointer','readonly']) !!}
    </div>
    {!! Form::label('Until DateTime',null,['for'=>'until', 'class'=>'col-sm-1 col-form-label','title'=>
    'until - If given, this must be a "Date" instance, that will specify the limit of the recurrence. If a recurrence instance happens to be the same as the"Date" instance given in the "until" argument, this will be the last occurrence.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','until',null, ['id'=>'until','class'=>'form-control until','style'=>'cursor: pointer','readonly']) !!}
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Count',null,['for'=>'count', 'class'=>'col-sm-2 text-right text','title'=>
    'How many occurrences will be generated.']) !!}
    <div class="col-sm-3">
        {!! Form::input('number','count',null, ['id'=>'count','class'=>'form-control','max'=>'500', 'min'=>'1']) !!}
    </div>
    {!! Form::label('Interval',null,['for'=>'interval', 'class'=>'col-sm-1 col-form-label','title'=>
    'The interval between each freq iteration. For example, when using "RRule.YEARLY", an interval of "2" means once every two years, but with "RRule.HOURLY", it means once every two hours. The default interval is "1".'
    ]) !!}
    <div class="col-sm-3">
        {!! Form::input('number','interval',null, ['id'=>'interval','class'=>'form-control','max'=>'50', 'min'=>'0']) !!}
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Week Start',null,['for'=>'wkst', 'class'=>'col-sm-2 text-right text','title'=>
    'The week start day. Must be one of the "RRule.MO", "RRule.TU", "RRule.WE" constants, or an integer, specifying the first day of the week. This will affect recurrences based on weekly periods. The default week start is "RRule.MO".'
    ]) !!}
    <div class="form-group">
        <label class="btn btn-primary ">
            {!! Form::radio('wkst','MO',null,['id'=>'wkst']) !!}<span> MO</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','TU',null,['id'=>'wkst']) !!}<span> TU</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','WE',null,['id'=>'wkst']) !!}<span> WE</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','TH',null,['id'=>'wkst']) !!}<span> TH</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','FR',null,['id'=>'wkst']) !!}<span> FR</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','SA',null,['id'=>'wkst']) !!}<span> SA</span></label>
        <label class="btn btn-warning">
            {!! Form::radio('wkst','SU',null,['id'=>'wkst']) !!}<span> SU</span></label>
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Week Days(s)',null,['for'=>'byday', 'class'=>'col-sm-2 text-right text','title'=>
    'If given, it must be either an integer ("0 == RRule.MO"), a sequence of integers, one of the weekday constants ("RRule.MO", "RRule.TU", etc), or a sequence of these constants. When given, these variables will define the weekdays where the recurrence will be applied. It is also possible to use an argument n for the weekday instances, which will mean the nth occurrence of this weekday in the period. For example, with "RRule.MONTHLY", or with "RRule.YEARLY" and "BYMONTH", using "RRule.FR.clone(+1)" in "byweekday" will specify the first friday of the month where the recurrence happens. Notice that the RFC documentation, this is specified as "BYDAY", but was renamed to avoid the ambiguity of that argument.'
    ]) !!}
    <div class="form-group">
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'MO',null,['id'=>'byday']) !!}<span> MO</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'TU',null,['id'=>'byday'])!!}<span> TU</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'WE',null,['id'=>'byday']) !!}<span> WE</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'TH',null,['id'=>'byday']) !!}<span> TH</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'FR',null,['id'=>'byday']) !!}<span> FR</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'SA',null,['id'=>'byday']) !!}<span> SA</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('byday[]', 'SU',null,['id'=>'byday']) !!}<span> SU</span></label>
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Month(s)',null,['for'=>'bymonth', 'class'=>'col-sm-2 text-right text','title'=>
    'If given, it must be either an integer, or a sequence of integers, meaning the months to apply the recurrence to.'
    ]) !!}
    <div class="form-group">
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '1',null,['id'=>'bymonth']) !!}<span> Jan</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '2',null,['id'=>'bymonth']) !!}<span> Feb</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '3',null,['id'=>'bymonth']) !!}<span> Mar</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '4',null,['id'=>'bymonth']) !!}<span> Apr</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '5',null,['id'=>'bymonth']) !!}<span> May</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '6',null,['id'=>'bymonth']) !!}<span> Jun</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '7',null,['id'=>'bymonth']) !!}<span> Jul</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '8',null,['id'=>'bymonth']) !!}<span> Aug</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '9',null,['id'=>'bymonth']) !!}<span> Sep</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '10',null,['id'=>'bymonth']) !!}<span> Oct</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '11',null,['id'=>'bymonth']) !!}<span> Nov</span></label>
        <label class="btn btn-primary">
            {!! Form::checkbox('bymonth[]', '12',null,['id'=>'bymonth']) !!}<span> Dec</span></label>
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Position',null,['for'=>'bysetpos', 'class'=>'col-sm-2 text-right text','title'=>
    'If given, it must be either an integer, or a sequence of integers, positive or negative. Each given integer will specify an occurrence number, corresponding to the nth occurrence of the rule inside the frequency period. For example, a "bysetpos" of "-1" if combined with a "RRule.MONTHLY" frequency, and a byweekday of ("RRule.MO", "RRule.TU", "RRule.WE", "RRule.TH", "FR"), will result in the last work day of every month.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','bysetpos',null, ['id'=>'bysetpos','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group d-flex align-items-center">
    {!! Form::label('Monthday',null,['for'=>'bymonthday', 'class'=>'col-sm-2 text-right text','title'=>
    'If given, it must be either an integer, or a sequence of integers, meaning the month days to apply the recurrence to.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','bymonthday',null, ['id'=>'bymonthday','class'=>'form-control']) !!}
    </div>
    {!! Form::label('Yearday',null,['for'=>'byyearday', 'class'=>'col-sm-1 col-form-label','title'=>
    'If given, it must be either an integer, or a sequence of integers, meaning the year days to apply the recurrence to.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','byyearday',null, ['id'=>'byyearday','class'=>'form-control']) !!}
    </div>
    {!! Form::label('Weeknumber',null,['for'=>'byweekno', 'class'=>'col-sm-1 col-form-label','title'=>
    'If given, it must be either an integer, or a sequence of integers, meaning the week numbers to apply the recurrence to. Week numbers have the meaning described in ISO8601, that is, the first week of the year is that containing at least four days of the new year.'
    ]) !!}
    <div class="col-sm-2">
        {!! Form::input('text','byweekno',null, ['id'=>'byweekno','class'=>'form-control']) !!}
    </div>
</div>
{{--<div class="form-group">
    {!! Form::label('Hour',null,['for'=>'byhour', 'class'=>'col-sm-2 text-right text','title'=> 'byhour - If given, it must
                    be either an integer, or a sequence of integers, meaning the hours to apply the recurrence to.']) !!}
    <div class="col-sm-2">
        {!! Form::input('text','byhour',null, ['class'=>'form-control','disabled'=>'true']) !!}
    </div>
    {!! Form::label('Minute',null,['for'=>'byminute', 'class'=>'col-sm-1 col-form-label','title'=> 'byminute - If given,
                    it must be either an integer, or a sequence of integers, meaning the minutes to apply the recurrence to.']) !!}
    <div class="col-sm-2">
        {!! Form::input('text','byminute',null, ['class'=>'form-control','disabled'=>'true']) !!}
    </div>
    {!! Form::label('Second',null,['for'=>'bysecond', 'class'=>'col-sm-1 col-form-label','title'=> 'bysecond - If given,
                    it must be either an integer, or a sequence of integers, meaning the seconds to apply the recurrence to.']) !!}
    <div class="col-sm-2">
        {!! Form::input('text','bysecond',null, ['class'=>'form-control','disabled'=>'true']) !!}
    </div>
</div>--}}
<div class="form-group d-flex align-items-center offset-2">
    {!! Form::button('Show proposed recurrence ',['onclick' => 'return showhuman()','class'=>'col-sm-4 btn btn-warning']) !!}
    {{--{!! Form::close() !!}--}}
    <script>
        function showhuman() {
            $.ajax({
                url: '{!! route("scheduler.gethuman") !!}',
                type: "POST",
                data: {
                    'title': 'Show Proposed',
                    'freq': $("#freq:checked").val(),
                    'start_date': $("#start_date").val(),
                    'end_date': $("#end_date").val(),
                    'until': $("#until").val(),
                    'count': $("#count").val(),
                    'interval': $("#interval").val(),
                    'wkst': $("#wkst:checked").val(),
                    'byday': $("#byday:checked").map(function () {
                        return $(this).val().toString();
                    }).get().join(","),
                    'bymonth': $("#bymonth:checked").map(function () {
                        return $(this).val().toString();
                    }).get().join(","),
                    'bysetpos': $("#bysetpos").val(),
                    'bymonthday': $("#bymonthday").val(),
                    'byyearday': $("#byyearday").val(),
                    'byweekno': $("#byweekno").val()
                },

                cache: false,
                success: function (data) {
                    if (data.type === 'success') {
                        Swal.fire({
                            title: 'Proposed Occurrence',
                            text: 'Frequency to text is  ' + data.result,
                            icon: 'info',
                            showConfirmButton: false,
                            timer: 5000
                        });

                    } else {
                        notify(data.data, 'error');

                    }
                },
                error: function (response) {
                    let msg = '';
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        msg += message + '\n';
                    });
                    notify(msg, 'error');
                }
            });

        }

    </script>
</div>
