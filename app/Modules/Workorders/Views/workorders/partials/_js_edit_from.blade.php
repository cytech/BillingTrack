<script type="text/javascript">
    $(function() {
        $('#btn-change-company_profile').click(function () {
            $('#modal-placeholder').load('{{ route('companyProfiles.ajax.modalLookup') }}', {
                id: {{ $workorder->id }},
                update_company_profile_route: '{{ route('workorders.workorderEdit.updateCompanyProfile') }}',
                refresh_from_route: '{{ route('workorders.workorderEdit.refreshFrom') }}'
            });
        });
    });
</script>
