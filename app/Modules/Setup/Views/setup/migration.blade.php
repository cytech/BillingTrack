@extends('setup.master')

@section('javaScript')
    <script type="text/javascript">
        $(function () {

            $('#btn-run-migration').click(function () {

                $('#btn-run-migration').hide();
                $('#btn-running-migration').show();

                $.post('{{ route('setup.postMigration') }}').done(function () {
                    $('#div-exception').hide();
                    $('#btn-running-migration').hide();
                    $('#btn-migration-complete').show();
                }).fail(function (response) {
                    if (response.status == 400) {
                        $('#div-exception').show().html($.parseJSON(response.responseText).exception);
                    } else {
                        alert('@lang('bt.unknown_error')');
                        $('#div-exception').hide();
                        $('#btn-running-migration').hide();
                        $('#btn-migration-complete').show();
                    }
                });
            });

        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1>@lang('bt.database_setup')</h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class=" card card-light">

                    <div class="card-body">

                        <div class="alert alert-error" id="div-exception" style="display: none;"></div>

                        <p>@lang('bt.step_database_setup')</p>

                        <a class="btn btn-primary" id="btn-run-migration">@lang('bt.continue')</a>

                        <a class="btn btn-secondary" id="btn-running-migration" style="display: none;" disabled="disabled">@lang('bt.installing_please_wait')</a>
                        <a href="{{ route('setup.account') }}" class="btn btn-success" id="btn-migration-complete" style="display: none;">@lang('bt.step_database_complete')</a>
                    </div>

                </div>

            </div>

        </div>

    </section>

@stop
