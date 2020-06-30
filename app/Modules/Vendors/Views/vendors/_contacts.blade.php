<script type="text/javascript">
    $(function () {
        $('#btn-add-contact').click(function () {
            $('#modal-placeholder').load('{{ route('vendors.contacts.create', [$vendorId]) }}');
        });

        $('.btn-edit-contact').click(function () {
            $('#modal-placeholder').load($(this).data('url'));
        });

        $('.btn-delete-contact').click(function () {

            Swal.fire({
                title: '@lang('bt.trash_record_warning')',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d68500',
                confirmButtonText: '@lang('bt.yes_sure')'
            }).then((result) => {
                if (result.value) {
                    $.post('{{ route('vendors.contacts.delete', [$vendorId]) }}', {
                        id: $(this).data('contact-id')
                    }).done(function (response) {
                        $('#tab-contacts').html(response);
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
        });

        $('.update-default').click(function () {
            $.post('{{ route('vendors.contacts.updateDefault', [$vendorId]) }}', {
                id: $(this).data('contact-id'),
                default: $(this).data('default')
            }).done(function (response) {
                $('#tab-contacts').html(response);
            });
        });
    });
</script>

@include('layouts._alerts')

<div class="row">
    <div class="col-lg-12">
        <div class="float-right mb-3">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btn-add-contact"><i
                        class="fa fa-plus"></i> @lang('bt.add_contact')</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>@lang('bt.name')</th>
                <th>@lang('bt.title')</th>
                <th>@lang('bt.phone')</th>
                <th>@lang('bt.fax')</th>
                <th>@lang('bt.mobile')</th>
                <th>@lang('bt.email')</th>
                <th>@lang('bt.default_to')</th>
                <th>@lang('bt.default_cc')</th>
                <th>@lang('bt.default_bcc')</th>
                <th>@lang('bt.is_primary')</th>
                <th>@lang('bt.optin')</th>
                <th>@lang('bt.options')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->title->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->fax }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->email }}</td>
                    <td><a href="javascript:void(0)" class="update-default" data-default="to"
                           data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_to }}</a></td>
                    <td><a href="javascript:void(0)" class="update-default" data-default="cc"
                           data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_cc }}</a></td>
                    <td><a href="javascript:void(0)" class="update-default" data-default="bcc"
                           data-contact-id="{{ $contact->id }}">{{ $contact->formatted_default_bcc }}</a></td>
                    <td>{{ $contact->formatted_is_primary }}</td>
                    <td>{{ $contact->formatted_optin }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                @lang('bt.options')
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="btn-edit-contact dropdown-item"
                                   data-url="{{ route('vendors.contacts.edit', [$vendorId, $contact->id]) }}"><i
                                            class="fa fa-edit"></i> @lang('bt.edit')</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="btn-delete-contact dropdown-item"
                                   data-contact-id={{ $contact->id }}><i class="fa fa-trash-alt"></i> @lang('bt.trash')
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
