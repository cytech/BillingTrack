<script type="text/javascript">

    $(function () {

        $('.vendor-lookup').autocomplete({
            source: '{{ route('expenses.lookupVendor') }}',
            minLength: 3
        }).autocomplete("widget");

    });

</script>