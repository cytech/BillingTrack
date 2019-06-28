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
                window.location = '{{ url('purchaseorders') }}';// + '/' + response.id + '/edit';
            }).fail(function (response) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
        });

    });

</script>
