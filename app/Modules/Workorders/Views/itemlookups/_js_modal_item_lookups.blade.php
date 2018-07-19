<script type="text/javascript">
    function setModalMaxHeight(element) {
        this.$element     = $(element);
        this.$content     = this.$element.find('.modal-content');
        var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
        var dialogMargin  = $(window).width() > 767 ? 60 : 20;
        var contentHeight = $(window).height() - (dialogMargin + borderWidth);
        var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
        var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
        var maxHeight     = contentHeight - (headerHeight + footerHeight);

        //cytech hardcoded modal width - default is auto (600px)
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

        // Creates the invoice
        $('#select-items-confirm').click(function()
        {
            var item_lookup_ids = [];

            $("input[name='item_lookup_ids[]']:checked").each(function ()
            {
                item_lookup_ids.push(parseInt($(this).val()));
            });

            $.post("{{ route('itemLookups.ajax.processItemLookup')}}", {
                item_lookup_ids: item_lookup_ids
            }, function(data) {
                items = JSON.parse(data);

                for(var key in items) {
                    if ($('#item-table tr:last input[name=name]').val() !== '') {
                        $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
                    }
                    //cytech added for resource info
                    $('#item-table tr:last input[name=resource_table]').val(items[key].resource_table);
                    $('#item-table tr:last input[name=resource_id]').val(items[key].resource_id);
                    $('#item-table tr:last input[name=name]').val(items[key].name);
                    $('#item-table tr:last textarea[name=description]').val(items[key].description);
                    $('#item-table tr:last input[name=price]').val(items[key].price);
                    $('#item-table tr:last select[name=tax_rate_id]').val(items[key].tax_rate_id);
                    $('#item-table tr:last select[name=tax_rate_2_id]').val(items[key].tax_rate_2_id);

                    //Cytech added to set qty to zero if item description is a worker (Worker-*)
                    // or name is a vehicle (Vehicle -*)
                    //if ((items[key].description.indexOf("Worker-") !== -1)||(items[key].description.indexOf("Manager-") !== -1)||(items[key].name.indexOf("Vehicle -") !== -1)) {
                    	//$('#item_table tr:last input[name=quantity]').val('0');
                    //}
                    //else {
                    	//$('#item_table tr:last input[name=quantity]').val('1');
                   // }
                    $('#item-table tr:last input[name=quantity]').val('0');

                    $('#modal-choose-items').modal('hide');
                }
            });
        });
    });

</script>