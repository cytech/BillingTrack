<script type="text/javascript">

    $(function () {
        // Make all existing items autocompletes
        $('.product').autocomplete({
            source: '{{ route('products.ajax.product') }}',
            minLength: 2
        }).autocomplete("widget");

        // All existing items should populate proper fields
        typeaheadTrigger();

        // Clones a new item row
        function cloneItemRow() {
            const row = $('#new-item').clone().appendTo('#item-table');
            row.removeAttr('id').addClass('item').show();
            row.find('input[name="name"]').addClass('product').autocomplete({
                source: '{{ route('products.ajax.product') }}',
                minLength: 2,
            }).autocomplete("widget");
            typeaheadTrigger();
            $('textarea').autosize();
        }

        // Sets up .product to populate proper fields when item is selected
        function typeaheadTrigger() {
            $('.product').on('autocompleteselect', function (obj, ui) {
                const row = $(this).closest('tr');
                row.find('textarea[name="description"]').val(ui.item.description);
                row.find('input[name="quantity"]').val('1');
                row.find('input[name="cost"]').val(ui.item.cost);
                row.find('select[name="tax_rate_id"]').val(ui.item.tax_rate_id);
                row.find('select[name="tax_rate_2_id"]').val(ui.item.tax_rate_2_id);
                //hide save_item_as_product checkbox
                $('#item-table tr:last label[for=save_item_as_product]').hide();
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
