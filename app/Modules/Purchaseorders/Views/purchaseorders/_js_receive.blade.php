<script type="text/javascript">

    $(function () {

        $('#receive-purchaseorder').modal();

        {{--$('#create-purchaseorder').on('shown.bs.modal', function () {--}}
        {{--    $("#create_vendor_name").focus();--}}
        {{--    $("#create_vendor_name").val(vendorName);--}}
        {{--    $('#create_vendor_name').autocomplete({--}}
        {{--        appendTo: '#create-purchaseorder',--}}
        {{--        source: '{{ route('vendors.ajax.lookup') }}',--}}
        {{--        minLength: 3--}}
        {{--    }).autocomplete("widget");--}}
        {{--});--}}

        {{--$('#create_purchaseorder_date').datetimepicker({format: '{{ config('bt.dateFormat') }}', timepicker: false, scrollInput: false});--}}

        $('#purchaseorder-receive-confirm').click(function () {

            const itemrec_ids = [];
            const itemrec_att = [];

            let itemrec = 0;

            $(".items-list tbody tr").each(function (i, row) {
                let $row = $(row),
                    $id = $row.find('input[name="id'),
                    $rec_qty = $row.find('input[name="rec_qty'),
                    $rec_cost = $row.find('input[name="rec_cost');

                let row_arr = {
                    id: parseInt($id.val()),
                    rec_qty: parseFloat($rec_qty.val()),
                    rec_cost: parseFloat($rec_cost.val())
                };

                itemrec_ids.push($id.val());
                itemrec_att.push(row_arr);
            });

            if ($("input[name='itemrec']").is(':checked')){
                itemrec = 1;
            }

            $.post('{{ route('purchaseorders.receive_items') }}', {
                user_id: $('#user_id').val(),
                itemrec: itemrec,
                itemrec_ids: itemrec_ids,
                itemrec_att: itemrec_att,

            }).done(function (response) {
                setTimeout(function () { //give notify a chance to display before redirect
                    window.location = '{!! url('purchaseorders') !!}';
                }, 2000);
                notify('@lang('bt.items_successfully_received')', 'success');
            }).fail(function (response) {
                if (response.status == 422) {
                    let msg = '';
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        msg += message + '\n';
                    });
                    notify(msg, 'error');
                } else {
                    notify('@lang('bt.unknown_error')', 'error');
                }
            });
        });

    });

</script>
