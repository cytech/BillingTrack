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
    <section class="content mt-3 mb-3">
        <h3 class="float-left">{{ trans('fi.mail_log') }}</h3>
        <div class="clearfix"></div>

    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <table id="dt-maillogtable" class="table dataTable no-footer">
                    <thead>
                    <tr>
                        <th>{{ trans('fi.date') }}</th>
                        <th>{{ trans('fi.from') }}</th>
                        <th>{{ trans('fi.to') }}</th>
                        <th>{{ trans('fi.cc') }}</th>
                        <th>{{ trans('fi.bcc') }}</th>
                        <th>{{ trans('fi.subject') }}</th>
                        <th>{{ trans('fi.sent') }}</th>
                        <th>{{ trans('fi.options') }}</th>
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
                                        {{ trans('fi.options') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"
                                               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('mailLog.delete', [$mail->id]) }}');"><i
                                                        class="fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
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
                paging: false,
                order: [[0, "asc"]],//order on id
                "columnDefs": [
                    {"orderable": false, "targets": 7}
                ]
            });
        });
    </script>
@stop