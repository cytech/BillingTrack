@include('workorders.partials._js_edit')

<section class="content-header">
    <h3 class="float-left">{{ trans('fi.workorder') }} #{{ $workorder->number }}</h3>

    @if ($workorder->viewed)
        <span style="margin-left: 10px;" class="badge badge-success">{{ trans('fi.viewed') }}</span>
    @else
        <span style="margin-left: 10px;" class="badge badge-secondary">{{ trans('fi.not_viewed') }}</span>
    @endif

    @if (($workorder->invoice))
        <span class="badge badge-info"><a href="{{ route('invoices.edit', [$workorder->invoice_id]) }}" style="color: inherit;">{{ trans('fi.converted_to_invoice') }} {{ $workorder->invoice->number }}</a></span>
    @endif

    @if ($workorder->quote()->count())
        <span class="badge badge-info"><a href="{{ route('quotes.edit', [$workorder->quote->id]) }}" style="color: inherit;">{{ trans('fi.converted_from_quote') }} {{ $workorder->quote->number }}</a></span>
    @endif

    <div class="float-right">

        <a href="{{ route('workorders.pdf', [$workorder->id]) }}" target="_blank" id="btn-pdf-workorder"
           class="btn btn-secondary"><i class="fa fa-print"></i> {{ trans('fi.pdf') }}</a>
        {{-- removed email button from workorders, there should not be emailing a customer a workorder, only a quote or invoice --}}
        {{--@if (config('fi.mailConfigured'))
            <a href="javascript:void(0)" id="btn-email-workorder" class="btn btn-secondary email-workorder"
               data-workorder-id="{{ $workorder->id }}" data-redirect-to="{{ route('workorders.edit', [$workorder->id]) }}"><i
                        class="fa fa-envelope"></i> {{ trans('fi.email') }}</a>
        @endif--}}

        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                {{ trans('fi.other') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" id="btn-copy-workorder"><i
                            class="fa fa-copy"></i> {{ trans('fi.copy_workorder') }}</a>
                <a class="dropdown-item" href="javascript:void(0)" id="btn-workorder-to-invoice"><i
                            class="fa fa-check"></i> {{ trans('fi.workorder_to_invoice') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                       onclick="swalConfirm('{{ trans('fi.trash_record_warning') }}', '{{ route('workorders.delete', [$workorder->id]) }}');"><i
                                class="fa fa-trash-alt"></i> {{ trans('fi.trash') }}</a>
            </div>
        </div>

        <div class="btn-group">
            @if ($returnUrl)
                <a href="{{ $returnUrl }}" class="btn btn-secondary"><i
                            class="fa fa-backward"></i> {{ trans('fi.back') }}</a>
            @endif
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-save-workorder"><i
                        class="fa fa-save"></i> {{ trans('fi.save') }}</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">

            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="#" class="btn-save-workorder"
                       data-apply-exchange-rate="1">{{ trans('fi.save_and_apply_exchange_rate') }}</a>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>
</section>

<section class="container-fluid">

    <div class="row">

        <div class="col-lg-10">

            @include('layouts._alerts')

            <div id="form-status-placeholder"></div>

            <div class="row">

                <div class="col-sm-6" id="col-from">

                    @include('workorders.partials._edit_from')

                </div>

                <div class="col-sm-6" id="col-to">

                    @include('workorders.partials._edit_to')

                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('fi.summary') }}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::text('summary', $workorder->summary, ['id' => 'summary', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-5 text-right text">{{ trans('fi.job_date') }}</label>
                    <div class="col-sm-7">
                    {!! Form::text('job_date', $workorder->formatted_job_date, ['id' =>
                    'job_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="start_time" class="col-sm-5 text-right text">{{ trans('fi.start_time') }}</label>
                    <div class="col-sm-7">
                    {!! Form::text('start_time', $workorder->formatted_start_time, ['id' =>
                    'start_time', 'class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="end_time" class="col-sm-5 text-right text">{{ trans('fi.end_time') }}</label>
                    <div class="col-sm-7">
                    {!! Form::text('end_time', $workorder->formatted_end_time, ['id' =>
                    'end_time', 'class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-6 text-right text">{{ trans('fi.will_call') }}</label>
                    <div class="col-sm-6">
                    {!! Form::checkbox('will_call', 1, $workorder->will_call, ['id' =>
                    'will_call', 'class' => 'checkbox']) !!}

                    <script>
                        $.fn.bootstrapSwitch.defaults.size = 'small';
                        $.fn.bootstrapSwitch.defaults.onText = 'Yes';
                        $.fn.bootstrapSwitch.defaults.offText = 'No';
                        $.fn.bootstrapSwitch.defaults.onColor = 'success';
                        $.fn.bootstrapSwitch.defaults.offColor = 'danger';
                        $("[name='will_call']").bootstrapSwitch();
                    </script>
                    </div>
                </div>

            </div>
            <br>


            <div class="row">

                <div class="col-sm-12 table-responsive" style="overflow-x: visible;">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('fi.items') }}</h3>

                            <div class="card-tools float-right">
                                <button class="btn btn-primary btn-sm" id="btn-add-item"><i
                                            class="fa fa-plus"></i> {{ trans('fi.add_item') }}</button>

                                <button class="btn btn-primary btn-sm" id="btn-add-lookup"><i
                                            class="fa fa-plus"></i> {{ trans('fi.add_lookup') }}</button>

                            </div>
                        </div>

                        <div class="card-body">
                            <table id="item-table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">{{ trans('fi.product') }}</th>
                                    <th style="width: 25%;">{{ trans('fi.description') }}</th>
                                    <th style="width: 10%;">{{ trans('fi.qty') }}</th>
                                    <th style="width: 10%;">{{ trans('fi.price') }}</th>
                                    <th style="width: 10%;">{{ trans('fi.tax_1') }}</th>
                                    <th style="width: 10%;">{{ trans('fi.tax_2') }}</th>
                                    <th style="width: 10%; text-align: right; padding-right: 25px;">{{ trans('fi.total') }}</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="new-item" style="display: none;">
                                    <td>
                                        {!! Form::hidden('workorder_id', $workorder->id) !!}
                                        {!! Form::hidden('id', '') !!}
                                        {!! Form::hidden('resource_table', '') !!}
                                        {!! Form::hidden('resource_id', '') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}<br>
                                        <label><input type="checkbox" name="save_item_as_lookup"
                                                      tabindex="999"> {{ trans('fi.save_item_as_lookup') }}</label>
                                    </td>
                                    <td>{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                    <td>{!! Form::text('quantity', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::text('price', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_id', $taxRates, config('fi.itemTaxRate'), ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_2_id', $taxRates, config('fi.itemTax2Rate'), ['class' => 'form-control']) !!}</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                @foreach ($workorder->items as $item)
                                    <tr class="item" id="tr-item-{{ $item->id }}">
                                        <td>
                                            {!! Form::hidden('workorder_id', $workorder->id) !!}
                                            {!! Form::hidden('id', $item->id) !!}
                                            {!! Form::hidden('resource_table', $item->resource_table) !!}
                                            {!! Form::hidden('resource_id', $item->resource_id) !!}
                                            {!! Form::text('name', $item->name, ['class' => 'form-control item-lookup']) !!}
                                        </td>
                                        <td>{!! Form::textarea('description', $item->description, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                        <td>{!! Form::text('quantity', $item->formatted_quantity, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::text('price', $item->formatted_numeric_price, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::select('tax_rate_id', $taxRates, $item->tax_rate_id, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::select('tax_rate_2_id', $taxRates, $item->tax_rate_2_id, ['class' => 'form-control']) !!}</td>
                                        <td style="text-align: right; padding-right: 25px;">{{ $item->amount->formatted_subtotal }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary btn-delete-workorder-item" href="#"
                                               title="{{ trans('fi.delete') }}" data-item-id="{{ $item->id }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-12">
                    <div class="card m-2">
                        <div class="card-header d-flex p-0">

                        <ul class="nav nav-tabs p-2">
                            <li class="nav-item"><a class="nav-link active show" href="#tab-additional" data-toggle="tab">{{ trans('fi.additional') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-notes" data-toggle="tab">{{ trans('fi.notes') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-attachments" data-toggle="tab">{{ trans('fi.attachments') }}</a></li>
                        </ul>
                        </div>
                        <div class="card-body">

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-additional">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                         <label>{{ trans('fi.terms_and_conditions') }}</label>
                                         {!! Form::textarea('terms', $workorder->terms, ['id' => 'terms', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ trans('fi.footer') }}</label>
                                            {!! Form::textarea('footer', $workorder->footer, ['id' => 'footer', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-notes">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('notes._notes', ['object' => $workorder, 'model' => 'FI\Modules\Workorders\Models\Workorder', 'showPrivateCheckbox' => true, 'hideHeader' => true])
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-attachments">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('attachments._table', ['object' => $workorder, 'model' => 'FI\Modules\Workorders\Models\Workorder'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <div class="col-lg-2">

            <div id="div-totals">
                @include('workorders.partials._edit_totals')
            </div>

            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('fi.options') }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ trans('fi.workorder') }} #</label>
                        {!! Form::text('number', $workorder->number, ['id' => 'number', 'class' =>
                        'form-control
                        form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.date') }}</label>
                        {!! Form::text('workorder_date', $workorder->formatted_workorder_date, ['id' =>
                        'workorder_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.status') }}</label>
                        {!! Form::select('workorder_status_id', $statuses, $workorder->workorder_status_id,
                        ['id' => 'workorder_status_id', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.expires') }}</label>
                        {!! Form::text('expires_at', $workorder->formatted_expires_at, ['id' => 'expires_at', 'class'
                        => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>{{ trans('fi.discount') }}</label>
                        <div class="input-group input-group-sm">
                            {!! Form::text('discount', $workorder->formatted_numeric_discount, ['id' =>
                            'discount', 'class' => 'form-control form-control-sm']) !!}
                            <div class="input-group-append">
                            <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('fi.currency') }}</label>
                        {!! Form::select('currency_code', $currencies, $workorder->currency_code, ['id' =>
                        'currency_code', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>{{ trans('fi.exchange_rate') }}</label>

                        <div class="input-group">
                            {!! Form::text('exchange_rate', $workorder->exchange_rate, ['id' =>
                            'exchange_rate', 'class' => 'form-control form-control-sm']) !!}
                            <span class="input-group-append">
                                <button class="btn btn-sm" id="btn-update-exchange-rate" type="button"
                                        data-toggle="tooltip" data-placement="left"
                                        title="{{ trans('fi.update_exchange_rate') }}"><i class="fa fa-sync"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('fi.template') }}</label>
                        {!! Form::select('template', $templates, $workorder->template,
                        ['id' => 'template', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if ($customFields->count())
        <div class="row">
            <div class="col-md-12">
                @include('custom_fields._custom_fields_unbound', ['object' => $workorder])
            </div>
        </div>
    @endif
</section>
