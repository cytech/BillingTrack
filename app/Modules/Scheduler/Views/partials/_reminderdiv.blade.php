<div class="reminder_delete_div">
    <div class="form-group">
        <hr class="col-sm-8 width60 hr-clr-green"/>
        <span class="col-sm-1 float-left reminder-cross-table delete_reminder"
              style="cursor: pointer"><i class="fa fa-times-circle"></i> </span>
    </div>
    <br>
    <div class="form-group">
        {!! Form::label('reminder_date',trans('bt.reminder_date'),['for'=>'reminder_date', 'class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::input('text','reminder_date[]',null, ['class'=>'form-control datepicker reminder_date ','style'=>'cursor: pointer','readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('reminder_location',trans('bt.reminder_location'),['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('reminder_location[]',null ,['class'=>'form-control','placeholder'=>'Reminder Location']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('reminder_text',trans('bt.reminder_text'),['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('reminder_text[]',null,['class'=>'form-control','placeholder'=>'Reminder Text']) !!}
        </div>
    </div>
</div>
