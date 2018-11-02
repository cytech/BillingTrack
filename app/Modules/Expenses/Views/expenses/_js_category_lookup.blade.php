<script type="text/javascript">

    $(function () {

        $('.category-lookup').autocomplete({
            source: '{{ route('expenses.lookupCategory') }}',
            minLength: 3
        }).autocomplete("widget");

    });

</script>