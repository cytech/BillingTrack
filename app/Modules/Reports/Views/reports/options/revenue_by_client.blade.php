@extends('layouts.master')

@section('javaScript')

    <script type="text/javascript">
        $(function () {

            $('#btn-run-report').click(function () {

                const company_profile_id = $('#company_profile_id').val();
                const year = $('#year').val();

                $.post("{{ route('reports.revenueByClient.validate') }}", {
                    company_profile_id: company_profile_id,
                    year: year
                }).done(function () {
                    clearErrors();
                    $('#form-validation-placeholder').html('');
                    const output_type = $("input[name=output_type]:checked").val();
                    query_string = "?company_profile_id=" + company_profile_id + "&year=" + year;
                    if (output_type === 'preview') {
                        $('#preview').show();
                        $('#preview-results').attr('src', "{{ route('reports.revenueByClient.html') }}" + query_string);
                    }
                    else if (output_type === 'pdf') {
                        window.location.href = "{{ route('reports.revenueByClient.pdf') }}" + query_string;
                    }
                }).fail(function (response) {
                    showErrors($.parseJSON(response.responseText).errors, '#form-validation-placeholder');
                });
            });
        });
    </script>

@stop

@section('content')

    <section class="content-header">
        <h1 class="float-left">@lang('bt.revenue_by_client')</h1>

        <div class="float-right">
            <button class="btn btn-primary" id="btn-run-report">@lang('bt.run_report')</button>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        <div id="form-validation-placeholder"></div>

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">@lang('bt.options')</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.company_profile'):</label>
                            {!! Form::select('company_profile_id', $companyProfiles, null, ['id' => 'company_profile_id', 'class' => 'form-control'])  !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('bt.year'):</label>
                            {!! Form::select('year', $years, date('Y'), ['id' => 'year', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-check-inline">
                            <label>@lang('bt.output_type'):</label>
                            <label class="form-check-label ml-3">
                                <input class="form-check-input" type="radio" name="output_type" value="preview"
                                       checked="checked"> @lang('bt.preview')
                            </label>
                            <label class="form-check-label ml-3">
                                <input class="form-check-input" type="radio" name="output_type"
                                       value="pdf"> @lang('bt.pdf')
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row" id="preview"
             style="height: 100%; background-color: #e6e6e6; padding: 25px; margin: 0; display: none;">
            <div class="col-lg-10 offset-1" style="background-color: white;">
                <iframe src="about:blank" id="preview-results" style="border: 0;width: 100%;overflow:hidden;"
                        onload="resizeIframe(this, 500);"></iframe>
            </div>
        </div>

    </section>

@stop
