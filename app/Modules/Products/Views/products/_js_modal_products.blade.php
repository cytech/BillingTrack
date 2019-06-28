<script type="text/javascript">
    function setModalMaxHeight(element) {
        this.$element     = $(element);
        this.$content     = this.$element.find('.modal-content');
        const borderWidth = this.$content.outerHeight() - this.$content.innerHeight();
        const dialogMargin = $(window).width() > 767 ? 60 : 20;
        const contentHeight = $(window).height() - (dialogMargin + borderWidth);
        const headerHeight = this.$element.find('.modal-header').outerHeight() || 0;
        const footerHeight = this.$element.find('.modal-footer').outerHeight() || 0;
        const maxHeight = contentHeight - (headerHeight + footerHeight);

        //hardcoded modal width - default is auto (600px)
        this.$element
                .find('.modal-dialog').css({
            'width': 750
        });

        this.$content.css({
            'overflow': 'hidden'
        });

        this.$element
                .find('.modal-body').css({
            'max-height': maxHeight,
            'overflow-y': 'auto'
        });

    }

    $('.modal').on('show.bs.modal', function() {
        $(this).show();
        setModalMaxHeight(this);
    });

    $(window).resize(function() {
        if ($('.modal.in').length != 0) {
            setModalMaxHeight($('.modal.in'));
        }
    });

    $(function()
    {
        // Display the create invoice modal
        $('#modal-choose-items').modal('show');
        //show only preferred vendor checkbox
        if ($("#pref_vendor").is(":checked")) {
            $("#product-table tr").filter(function () {
                $(this).toggle($(this).data('vendor_id') === $(this).data('purch_vendor_id'))
            });
        }
        $("#pref_vendor").on("change", function() {
            if ($(this).is(":checked")) {
                $("#product-table tr").filter(function () {
                    $(this).toggle($(this).data('vendor_id') === $(this).data('purch_vendor_id'))
                });
            }else {
                $("#product-table tr").filter(function () {
                    $(this).show($(this).data('vendor_id') > -1)
                });
            }
        });

        // Creates the invoice
        $('#select-items-confirm').click(function()
        {
            const product_ids = [];

            $("input[name='product_ids[]']:checked").each(function ()
            {
                product_ids.push(parseInt($(this).val()));
            });

            $.post("{{ route('products.ajax.processProduct')}}", {
                product_ids: product_ids
            }, function(data) {
                items = JSON.parse(data);

                for(let key in items) {
                    if ($('#item-table tr:last input[name=name]').val() !== '') {
                        $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
                    }
                    //added for resource info
                    $('#item-table tr:last input[name=resource_table]').val(items[key].resource_table);
                    $('#item-table tr:last input[name=resource_id]').val(items[key].resource_id);
                    $('#item-table tr:last input[name=name]').val(items[key].name);
                    $('#item-table tr:last textarea[name=description]').val(items[key].description);
                    $('#item-table tr:last input[name=cost]').val(items[key].cost);
                    $('#item-table tr:last select[name=tax_rate_id]').val(items[key].tax_rate_id);
                    $('#item-table tr:last select[name=tax_rate_2_id]').val(items[key].tax_rate_2_id);
                    $('#item-table tr:last input[name=quantity]').val('0');

                    $('#modal-choose-items').modal('hide');
                }
            });
        });
    });

</script>
