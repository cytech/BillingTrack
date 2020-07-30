@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.mail_log')</h3>
        <div class="clearfix"></div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <script type="text/javascript">
                    $(function () {
                        $('.btn-show-content').click(function () {
                            $('#modal-placeholder').load('{{ route('mailLog.content') }}', {
                                id: $(this).data('id')
                            });
                        });
                    });
                </script>
                {!! $dataTable->table(['class' => 'table table-striped display', 'width' => '100%', 'cellspacing' => '0']) !!}
            </div>
        </div>
    </section>
@stop
@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
