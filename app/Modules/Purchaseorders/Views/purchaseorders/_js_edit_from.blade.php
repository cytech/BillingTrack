<script type="text/javascript">
    $(function () {
        $('#btn-change-company-profile').click(function () {
            $('#modal-placeholder').load('{{ route('companyProfiles.ajax.modalLookup') }}', {
                id: {{ $purchaseorder->id }},
                update_company_profile_route: '{{ route('purchaseorderEdit.updateCompanyProfile') }}',
                refresh_from_route: '{{ route('purchaseorderEdit.refreshFrom') }}'
            });
        });
    });
</script>
