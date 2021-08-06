<script type="text/javascript">

    $(function () {
        // Make all existing items autocompletes
        $('.item-lookup').autocomplete({
            source: '{{ route('itemLookups.ajax.itemLookup') }}',
            minLength: 2
        }).autocomplete("widget");

        // All existing items should populate proper fields
        typeaheadTrigger();

        // Clones a new item row
        function cloneItemRow() {
            const row = $('#new-item').clone().appendTo('#item-table');
            row.removeAttr('id').addClass('item').show();
            row.find('input[name="name"]').addClass('item-lookup').autocomplete({
                source: '{{ route('itemLookups.ajax.itemLookup') }}',
                minLength: 2,
            }).autocomplete("widget");
            typeaheadTrigger();
            $('textarea').autosize();
        }

        // Sets up .item-lookup to populate proper fields when item is selected
        function typeaheadTrigger() {
            $('.item-lookup').on('autocompleteselect', function (obj, ui) {
                const row = $(this).closest('tr');
                row.find('textarea[name="description"]').val(ui.item.description);
                row.find('input[name="quantity"]').val('1');
                row.find('input[name="price"]').val(ui.item.price);
                row.find('select[name="tax_rate_id"]').val(ui.item.tax_rate_id);
                row.find('select[name="tax_rate_2_id"]').val(ui.item.tax_rate_2_id);
                row.find('input[name="resource_table"]').val(ui.item.resource_table);
                row.find('input[name="resource_id"]').val(ui.item.resource_id);
                // remove save_item_as_lookup checkbox
                row.find('label[for="save_item_as_lookup"]').hide();
            });
        }

        $(document).on('click', '#btn-add-item', function () {
            cloneItemRow();
        });

        // Add a new item row if no items currently exist
        @if (!$itemCount)
        cloneItemRow();
        @endif


    });

</script>
