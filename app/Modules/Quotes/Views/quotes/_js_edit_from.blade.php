<script type="text/javascript">
    $(function () {
        $('#btn-change-company_profile').click(function () {
            $('#modal-placeholder').load('{{ route('companyProfiles.ajax.modalLookup') }}', {
                id: {{ $quote->id }},
                update_company_profile_route: '{{ route('quotes.quoteEdit.updateCompanyProfile') }}',
                refresh_from_route: '{{ route('quotes.quoteEdit.refreshFrom') }}'
            });
        });
    });
</script>
