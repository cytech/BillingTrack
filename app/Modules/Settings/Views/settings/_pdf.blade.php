@section('javaScript')
    @parent
    <script type="text/javascript">
        $(function () {

            updatePDFOptions();

            $('#pdfDriver').change(function () {
                updatePDFOptions();
            });

            function updatePDFOptions() {

                $('.wkhtmltopdf-option').hide();

                pdfDriver = $('#pdfDriver').val();

                if (pdfDriver == 'wkhtmltopdf') {
                    $('.wkhtmltopdf-option').show();
                }
            }

        });
    </script>
@stop

<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.paper_size'): </label>
            {!! Form::select('setting[paperSize]', $paperSizes, config('bt.paperSize'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.paper_orientation'): </label>
            {!! Form::select('setting[paperOrientation]', $paperOrientations, config('bt.paperOrientation'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.pdf_disposition'): </label>
            {!! Form::select('setting[pdfDisposition]', $pdfDisposition, config('bt.pdfDisposition'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

<div class="form-group">
    <label>@lang('bt.pdf_driver'): </label>
    {!! Form::select('setting[pdfDriver]', $pdfDrivers, config('bt.pdfDriver'), ['id' => 'pdfDriver', 'class' => 'form-control']) !!}
</div>

<div class="form-group wkhtmltopdf-option">
    <label>@lang('bt.binary_path'): </label>
    {!! Form::text('setting[pdfBinaryPath]', config('bt.pdfBinaryPath'), ['class' => 'form-control']) !!}
</div>
