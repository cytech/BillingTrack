<script type="text/javascript">

    $(function () {

        $('#change_client_name').autocomplete({
            appendTo: '#modal-lookup-client',
            source: '{{ route('clients.ajax.lookup') }}',
            minLength: 3
        }).autocomplete("widget");

    });

</script>