@include('recurring_invoices._js_edit')

<section class="content-header">
    <h3 class="float-left">@lang('bt.recurring_invoice') #{{ $recurringInvoice->id }}</h3>

    <div class="float-right">

        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                @lang('bt.other')
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" id="btn-copy-recurring-invoice"><i
                            class="fa fa-copy"></i> @lang('bt.copy')</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                       onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('recurringInvoices.delete', [$recurringInvoice->id]) }}');"><i
                            class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
            </div>
        </div>

        <div class="btn-group">
            @if ($returnUrl)
                <a href="{{ $returnUrl }}" class="btn btn-secondary"><i
                        class="fa fa-backward"></i> @lang('bt.back')</a>
            @endif
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-save-recurring-invoice"><i
                    class="fa fa-save"></i> @lang('bt.save')</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">

            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="#" class="btn-save-recurring-invoice"
                       data-apply-exchange-rate="1">@lang('bt.save_and_apply_exchange_rate')</a>
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

                    @include('recurring_invoices._edit_from')

                </div>

                <div class="col-sm-6" id="col-to">

                    @include('recurring_invoices._edit_to')

                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">@lang('bt.summary')</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::text('summary', $recurringInvoice->summary, ['id' => 'summary', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-12 table-responsive" style="overflow-x: visible;">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">@lang('bt.items')</h3>

                            <div class="card-tools float-right">
                                <button class="btn btn-primary btn-sm" id="btn-add-item"><i
                                        class="fa fa-plus"></i> @lang('bt.add_item')</button>
                                <button class="btn btn-primary btn-sm" id="btn-add-product"><i
                                            class="fa fa-plus"></i> @lang('bt.add_product')</button>
                                <button class="btn btn-primary btn-sm" id="btn-add-employee"><i
                                            class="fa fa-plus"></i> @lang('bt.add_employee')</button>
                                <button class="btn btn-primary btn-sm" id="btn-add-lookup"><i
                                            class="fa fa-plus"></i> @lang('bt.add_lookup')</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="item-table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">@lang('bt.product')</th>
                                    <th style="width: 25%;">@lang('bt.description')</th>
                                    <th style="width: 10%;">@lang('bt.qty')</th>
                                    <th style="width: 10%;">@lang('bt.price')</th>
                                    <th style="width: 10%;">@lang('bt.tax_1')</th>
                                    <th style="width: 10%;">@lang('bt.tax_2')</th>
                                    <th style="width: 10%; text-align: right; padding-right: 25px;">@lang('bt.total')</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="new-item" style="display: none;">
                                    <td>
                                        {!! Form::hidden('recurring_invoice_id', $recurringInvoice->id) !!}
                                        {!! Form::hidden('id', '') !!}
                                        {!! Form::hidden('resource_table', '') !!}
                                        {!! Form::hidden('resource_id', '') !!}
                                        {!! Form::search('name', null, ['class' => 'form-control', 'title' => 'Autocomplete from Item Lookups', 'autocomplete' => "off"]) !!}<br>
                                        <label for="save_item_as_lookup"><input type="checkbox" name="save_item_as_lookup" tabindex="999"> @lang('bt.save_item_as_lookup')</label>
                                    </td>
                                    <td>{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                    <td>{!! Form::text('quantity', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::text('price', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_id', $taxRates, config('bt.itemTaxRate'), ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_2_id', $taxRates, config('bt.itemTax2Rate'), ['class' => 'form-control']) !!}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($recurringInvoice->items as $item)
                                    <tr class="item" id="tr-item-{{ $item->id }}">
                                        <td>
                                            {!! Form::hidden('recurring_invoice_id', $recurringInvoice->id) !!}
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
                                            <a class="btn btn-sm btn-secondary btn-delete-recurring-invoice-item" href="javascript:void(0);"
                                               title="@lang('bt.trash')" data-item-id="{{ $item->id }}">
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
                            <li class="nav-item"><a class="nav-link active show" href="#tab-additional" data-toggle="tab">@lang('bt.additional')</a></li>
                        </ul>
                        </div>
                        <div class="card-body">

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-additional">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('bt.terms_and_conditions')</label>
                                            {!! Form::textarea('terms', $recurringInvoice->terms, ['id' => 'terms', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('bt.footer')</label>
                                            {!! Form::textarea('footer', $recurringInvoice->footer, ['id' => 'footer', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>
                                </div>

                                @if ($customFields->count())
                                    <div class="row">
                                        <div class="col-md-12">
                                            @include('custom_fields._custom_fields_unbound', ['object' => $recurringInvoice])
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-2">

            <div id="div-totals">
                @include('recurring_invoices._edit_totals')
            </div>

            <div class="card card-light">

                <div class="card-header">
                    <h3 class="card-title">@lang('bt.options')</h3>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>@lang('bt.next_date')</label>
                        {!! Form::text('next_date', $recurringInvoice->formatted_next_date, ['id' => 'next_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.every')</label>
                        <div class="row">
                            <div class="col-5">
                                {!! Form::select('recurring_frequency', array_combine(range(1, 90), range(1, 90)), $recurringInvoice->recurring_frequency, ['id' => 'recurring_frequency', 'class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="col-7">
                                {!! Form::select('recurring_period', $frequencies, $recurringInvoice->recurring_period, ['id' => 'recurring_period', 'class' => 'form-control form-control-sm']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.stop_date')</label>
                        {!! Form::text('stop_date', $recurringInvoice->formatted_stop_date, ['id' => 'stop_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.discount')</label>
                        <div class="input-group input-group-sm">
                            {!! Form::text('discount', $recurringInvoice->formatted_numeric_discount, ['id' =>
                            'discount', 'class' => 'form-control form-control-sm']) !!}
                            <div class="input-group-append">
                            <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.currency')</label>
                        {!! Form::select('currency_code', $currencies, $recurringInvoice->currency_code, ['id' =>
                        'currency_code', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.exchange_rate')</label>
                        <div class="input-group">
                            {!! Form::text('exchange_rate', $recurringInvoice->exchange_rate, ['id' => 'exchange_rate', 'class' => 'form-control form-control-sm']) !!}
                            <span class="input-group-append">
                                <button class="btn btn-sm" id="btn-update-exchange-rate" type="button"
                                        data-toggle="tooltip" data-placement="left" title="@lang('bt.update_exchange_rate')">
                                    <i class="fa fa-sync"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.group')</label>
                        {!! Form::select('group_id', $groups, $recurringInvoice->group_id, ['id' => 'group_id', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.template')</label>
                        {!! Form::select('template', $templates, $recurringInvoice->template, ['id' => 'template', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                </div>
            </div>
        </div>

    </div>

</section>
