<div class="form-group">
@foreach ($customFields as $customField)
        <div class="col-md-4">
        <label>{{ $customField->field_label }}</label>
        @if ($customField->field_type == 'dropdown')
            {!! Form::select('custom[' . $customField->column_name . ']', array_combine(array_merge([''], explode(',', $customField->field_meta)), array_merge([''], explode(',', $customField->field_meta))), (isset($object->custom->{$customField->column_name}) ? $object->custom->{$customField->column_name} : null), ['class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]) !!}
        @else
            {!! call_user_func_array('Form::' . $customField->field_type, ['custom[' . $customField->column_name . ']',
                (isset($object->custom->{$customField->column_name}) ? ($customField->column_name == 'job_date')? FI\Modules\Workorders\Support\DateFormatter::format($object->custom->{$customField->column_name}):$object->custom->{$customField->column_name} : null),
                ($customField->column_name == 'job_date') ?
                (['id' => 'job_date', 'class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]) :
                        (($customField->column_name == 'start_time') ?
                         (['id' => 'start_time', 'class' => 'custom-form-field form-control bootstrap-timepicker timepicker',
                          'data-field-name' => $customField->column_name]):
                         (['class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]))]) !!}
        @endif
        </div>
@endforeach
    <br><br><br><br>
</div>

{{--{!! call_user_func_array('Form::' . $customField->field_type, ['custom[' . $customField->column_name . ']',
                (isset($object->custom->{$customField->column_name}) ? ($customField->column_name == 'job_date')? FI\Modules\Workorders\Support\DateFormatter::format($object->custom->{$customField->column_name}):$object->custom->{$customField->column_name} : null),
                 $customField->column_name == 'job_date'?
                ['id' => 'job_date','class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]:
                ['id' => 'start_time','class' => 'custom-form-field form-control bootstrap-timepicker timepicker', 'data-field-name' => $customField->column_name]]) !!}--}}

{{--{!! call_user_func_array('Form::' . $customField->field_type, ['custom[' . $customField->column_name . ']',
                (isset($object->custom->{$customField->column_name}) ? ($customField->column_name == 'job_date')? FI\Modules\Workorders\Support\DateFormatter::format($object->custom->{$customField->column_name}):$object->custom->{$customField->column_name} : null),
                 $customField->column_name == 'job_date'?
                ['id' => 'job_date','class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]:
                ['class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]]) !!}--}}

{{--{!! call_user_func_array('Form::' . $customField->field_type, ['custom[' . $customField->column_name . ']',--}}
                {{--(isset($object->custom->{$customField->column_name}) ? $object->custom->{$customField->column_name} : null),--}}
                 {{--$customField->column_name == 'job_date'?--}}
                {{--['id' => 'job_date','class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]:--}}
                {{--['class' => 'custom-form-field form-control', 'data-field-name' => $customField->column_name]]) !!}--}}

