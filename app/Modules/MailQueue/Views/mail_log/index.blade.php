@extends('layouts.master')

@section('javascript')
    <script type="text/javascript">
        $(function() {
            $('.btn-show-content').click(function() {
                $('#modal-placeholder').load('{{ route('mailLog.content') }}', {
                    id: $(this).data('id')
                });
            });
        });
    </script>
@stop

@section('content')

    <section class="content-header">
        <h1>{{ trans('fi.mail_log') }}</h1>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
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
                                    <td><a href="javascript:void(0)" class="btn-show-content" data-id="{{ $mail->id }}">{{ $mail->subject }}</a></td>
                                    <td>{{ $mail->formatted_sent }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"
                                                       onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('mailLog.delete', [$mail->id]) }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.trash') }}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

                {{--<div class="pull-right">--}}
                    {{--{!! $mails->appends(request()->except('page'))->render() !!}--}}
                {{--</div>--}}

            </div>

        </div>

    </section>
    <script>
        $(function () {
            {{--for employees DT--}}
            $('#dt-maillogtable').DataTable({
                paging: false,
                //searching: true,
                order: [[0, "asc"]],//order on id
                "columnDefs": [
                    {"orderable": false, "targets": 7}
                ]
                //dom: 'T<"clear">lfrtip'
            });
        });
    </script>
@stop