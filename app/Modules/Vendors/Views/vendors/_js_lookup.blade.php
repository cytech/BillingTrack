<script type="text/javascript">

    $(function () {

        $('#change_vendor_name').autocomplete({
            appendTo: '#modal-lookup-vendor',
            source: '{{ route('vendors.ajax.lookup') }}',
            minLength: 3
        }).autocomplete("widget");

    });

</script>
