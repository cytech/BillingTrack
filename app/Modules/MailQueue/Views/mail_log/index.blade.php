@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('.btn-show-content').click(function () {
                $('#modal-placeholder').load('{{ route('mailLog.content') }}', {
                    id: $(this).data('id')
                });
            });
        });
    </script>
@stop

@section('content')
    <section class="content-header">
        <h3 class="float-left">@lang('bt.mail_log')</h3>
        <div class="clearfix"></div>

    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <table id="dt-maillogtable" class="table dataTable no-footer">
                    <thead>
                    <tr>
                        <th>@lang('bt.date')</th>
                        <th>@lang('bt.from')</th>
                        <th>@lang('bt.to')</th>
                        <th>@lang('bt.cc')</th>
                        <th>@lang('bt.bcc')</th>
                        <th>@lang('bt.subject')</th>
                        <th>@lang('bt.sent')</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mails as $mail)
                        <tr>
                            <td>{{ $mail->formatted_created_at }}</td>
                            <td>{{ $mail->formatted_from }}</td>
                            <td>{{ $mail->formatted_to }}</td>
                            <td>{{ $mail->formatted_cc }}</td>
                            <td>{{ $mail->formatted_bcc }}</td>
                            <td><a href="javascript:void(0)" class="btn-show-content"
                                   data-id="{{ $mail->id }}">{{ $mail->subject }}</a></td>
                            <td>{{ $mail->formatted_sent }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"
                                               onclick="swalConfirm('@lang('bt.delete_record_warning')', '{{ route('mailLog.delete', [$mail->id]) }}');"><i
                                                        class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            {{--for employees DT--}}
            $('#dt-maillogtable').DataTable({
                paging: true,
                order: [[0, "asc"]],//order on id
                "columnDefs": [
                    {"orderable": false, "targets": 7}
                ]
            });
        });
    </script>
@stop
