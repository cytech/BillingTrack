<script type="text/javascript">
    $(function() {
        $('#btn-add-contact').click(function() {
            $('#modal-placeholder').load('{{ route('clients.contacts.create', [$clientId]) }}');
        });

        $('.btn-edit-contact').click(function() {
            $('#modal-placeholder').load($(this).data('url'));
        });

        $('.btn-delete-contact').click(function() {

            Swal({
                title: '@lang('fi.trash_record_warning')',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d68500',
                confirmButtonText: '{!! trans('fi.yes_sure') !!}'
            }).then((result) => {
                if (result.value) {
                    $.post('{{ route('clients.contacts.delete', [$clientId]) }}', {
                        id: $(this).data('contact-id')
                    }).done(function(response) {
                        $('#tab-contacts').html(response);
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
        });

        $('.update-default').click(function() {
            $.post('{{ route('clients.contacts.updateDefault', [$clientId]) }}', {
                id: $(this).data('contact-id'),
                default: $(this).data('default')
            }).done(function(response) {
                $('#tab-contacts').html(response);
            });
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="float-right">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btn-add-contact"><i class="fa fa-plus"></i> @lang('fi.add_contact')</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>@lang('fi.name')</th>
                <th>@lang('fi.email')</th>
                <th>@lang('fi.default_to')</th>
                <th>@lang('fi.default_cc')</th>
                <th>@lang('fi.default_bcc')</th>
                <th>@lang('fi.options')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td><a href="javascript:void(0)" class="update-default" data-default="to" data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_to }}</a></td>
                <td><a href="javascript:void(0)" class="update-default" data-default="cc" data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_cc }}</a></td>
                <td><a href="javascript:void(0)" class="update-default" data-default="bcc" data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_bcc }}</a></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                            @lang('fi.options')
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0)" class="btn-edit-contact dropdown-item" data-url="{{ route('clients.contacts.edit', [$clientId, $contact->id]) }}"><i class="fa fa-edit"></i> @lang('fi.edit')</a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="btn-delete-contact dropdown-item" data-contact-id={{ $contact->id }}><i class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>