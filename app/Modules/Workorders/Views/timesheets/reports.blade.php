@extends('Workorders::partials._master')

@section('content')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if (exist) {
            alert(msg);
        }
    </script>
    <section class="content">
        {!! Form::wobreadcrumbs() !!}
        <div id="form-validation-placeholder"></div>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ trans('Workorders::texts.getdates',['name' => $title]) }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.company_profile') }}:</label>
                                    {!! Form::select('company_profile_id', $companyProfiles, null, ['id' => 'company_profile_id', 'class' => 'form-control'])  !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.date_range') }}:</label>
                                    {!! Form::hidden('from_date', null, ['id' => 'from_date']) !!}
                                    {!! Form::hidden('to_date', null, ['id' => 'to_date']) !!}
                                    {!! Form::text('date_range', null, ['id' => 'date_range', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label>{{ trans('fi.output_type') }}</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="output_type" value="preview"
                                               checked="checked"> {{ trans('fi.preview') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="output_type" value="pdf"> {{ trans('fi.pdf') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="output_type" value="iif"> {{ trans('Workorders::texts.export_to_timer') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div style="text-align:center" class="buttons">
                    <div class="col-md-12 text-center">
                        <a class="btn btn-warning btn-lg" href={!! route('workorders.dashboard')  !!}>{{ trans('fi.cancel') }} <span
                                    class="glyphicon glyphicon-remove-circle"></span></a>
                        <button type="submit" class="btn btn-success btn-lg " id="btn-run-report">{{ trans('Workorders::texts.run_report') }} <span
                                    class="glyphicon glyphicon-floppy-disk"></span></button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row" id="preview"
             style="height: 100%; background-color: #e6e6e6; padding: 25px; margin: 0; display: none;">
            <div class="col-lg-8 col-lg-offset-2" style="background-color: white;">
                <iframe src="about:blank" id="preview-results" frameborder="0" style="width: 100%;" scrolling="no"
                        onload="resizeIframe(this, 500);"></iframe>
            </div>
        </div>

    </section>

@stop

@section('javascript')

    @include('Workorders::timesheets._mod_daterangepicker')
    {{--@include('Workorders::layouts._typeahead')--}}

    <script type="text/javascript">
        $(function () {
            $('#btn-run-report').click(function () {

                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var company_profile_id = $('#company_profile_id').val();

                $.post("{{ route('timesheets.validate') }}", {
                    from_date: from_date,
                    to_date: to_date,
                    company_profile_id: company_profile_id
                }).done(function () {
                    clearErrors();
                    $('#form-validation-placeholder').html('');
                    output_type = $("input[name=output_type]:checked").val();
                    query_string = "?from_date=" + from_date + "&to_date=" + to_date + "&company_profile_id=" + company_profile_id;
                    if (output_type == 'preview') {
                        $('#preview').show();
                        $('#preview-results').attr('src', "{{ route('timesheets.html') }}" + query_string);
                    }
                    else if (output_type == 'pdf') {
                        window.location.href = "{{ route('timesheets.pdf') }}" + query_string;
                    }
                    else if (output_type == 'iif') {
                        window.location.href = "{{ route('timesheets.iif') }}" + query_string;
                    }

                }).fail(function (response) {
                    showErrors($.parseJSON(response.responseText), '#form-validation-placeholder');
                });
            });
        });
    </script>
@stop

