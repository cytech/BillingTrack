<script type="text/javascript">
    $(function () {

        $('#modal-bill-task').modal();

        const howToBill = $('#how_to_bill');
        const invoiceCount = '{{ $invoiceCount }}';

        billOptions(howToBill.val(), invoiceCount);

        howToBill.change(function () {
            billOptions($(this).val(), invoiceCount);
        });

        $('#btn-submit-bill').click(function() {

            $.post("{{ route('timeTracking.bill.store') }}", {
                how_to_bill: howToBill.val(),
                project_id: {{ $project->id }},
                group_id: $('#group_id').val(),
                invoice_id: $('#invoice_id').val(),
                task_ids: JSON.stringify({{ $taskIds }})
            }, function(response) {
                window.location = response;
            });

        });

        function billOptions(howToBill, invoiceCount) {

            $('#div-bill-new').hide();
            $('#div-bill-existing').hide();

            $('#div-bill-' + howToBill).show();

            if (howToBill == 'existing' && invoiceCount == 0) {
                $('#btn-submit-bill').addClass('disabled');
            }
            else {
                $('#btn-submit-bill').removeClass('disabled');
            }
        }
    });
</script>

<div class="modal fade" id="modal-bill-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.how_to_bill')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::select('how_to_bill', ['new' => trans('bt.bill_to_new_invoice'), 'existing' => trans('bt.bill_to_existing_invoice')], null, ['id' => 'how_to_bill', 'class' => 'form-control']) !!}
                </div>

                <div id="div-bill-new" style="display: none;">

                    <div class="form-group">

                        <label>@lang('bt.group'):</label>
                            {!! Form::select('group_id', $groups, config('bt.invoiceGroup'),
                            ['id' => 'group_id', 'class' => 'form-control']) !!}
                        </div>

                </div>

                <div id="div-bill-existing" style="display: none;">

                    <div class="form-group">
                        <label>@lang('bt.choose_invoice_to_bill'):</label>
                        {!! Form::select('invoice_id', $invoices, null, ['class' => 'form-control', 'id' => 'invoice_id']) !!}
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" class="btn btn-primary" id="btn-submit-bill">@lang('bt.submit')</button>
            </div>
        </div>
    </div>
</div>
