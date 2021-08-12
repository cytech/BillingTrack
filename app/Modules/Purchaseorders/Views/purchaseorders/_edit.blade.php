@include('purchaseorders._js_edit')

<section class="content-header">
    <h3 class="float-left">@lang('bt.purchaseorder') #{{ $purchaseorder->number }}</h3>
    @if ($purchaseorder->status_text)
        <span style="margin-left: 10px;" class="badge badge-{{strtolower($purchaseorder->status_text)}}">@lang('bt.'.$purchaseorder->status_text)</span>
{{--    @else--}}
{{--        <span style="margin-left: 10px;" class="badge badge-secondary">@lang('bt.not_viewed')</span>--}}
    @endif

    {{--    @if ($purchaseorder->quote()->count())--}}
    {{--        <span class="badge badge-info"><a href="{{ route('quotes.edit', [$purchaseorder->quote->id]) }}" style="color: inherit;">@lang('bt.converted_from_quote') {{ $purchaseorder->quote->number }}</a></span>--}}
    {{--    @endif--}}

    {{--    @if ($purchaseorder->workorder()->count())--}}
    {{--        <span class="badge badge-info"><a href="{{ route('workorders.edit', [$purchaseorder->workorder->id]) }}" style="color: inherit;">@lang('bt.converted_from_workorder') {{ $purchaseorder->workorder->number }}</a></span>--}}
    {{--    @endif--}}
    <div class="float-right">
        <a href="{{ route('purchaseorders.pdf', [$purchaseorder->id]) }}" target="_blank" id="btn-pdf-purchaseorder"
           class="btn btn-secondary"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        @if (config('bt.mailConfigured'))
            <a href="javascript:void(0)" id="btn-email-purchaseorder" class="btn btn-secondary email-purchaseorder"
               data-purchaseorder-id="{{ $purchaseorder->id }}"
               data-redirect-to="{{ route('purchaseorders.edit', [$purchaseorder->id]) }}"><i
                        class="fa fa-envelope"></i> @lang('bt.email')</a>
        @endif
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                @lang('bt.other')
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                {{--                @if ($purchaseorder->isPayable or config('bt.allowPaymentsWithoutBalance'))--}}
                {{--                    <a class="dropdown-item enter-payment" href="javascript:void(0)" id="btn-enter-payment"--}}
                {{--                           data-purchaseorder-id="{{ $purchaseorder->id }}"--}}
                {{--                           data-purchaseorder-balance="{{ $purchaseorder->amount->formatted_numeric_balance }}"--}}
                {{--                           data-redirect-to="{{ route('purchaseorders.edit', [$purchaseorder->id]) }}"><i--}}
                {{--                                class="fa fa-credit-card"></i> @lang('bt.enter_payment')</a>--}}
                {{--                @endif--}}
                @if($purchaseorder->status_text != 'received')
                    <a class="dropdown-item receive-purchaseorder" href="javascript:void(0)" data-purchaseorder-id="{{ $purchaseorder->id }}" ><i
                                class="fa fa-arrow-alt-circle-right" ></i> @lang('bt.receive')</a>
                @endif
                <a class="dropdown-item" href="javascript:void(0)" id="btn-copy-purchaseorder"><i
                            class="fa fa-copy"></i> @lang('bt.copy')</a>
                {{--                <a class="dropdown-item" href="{{ route('vendorCenter.public.purchaseorder.show', [$purchaseorder->url_key]) }}" target="_blank"><i--}}
                {{--                            class="fa fa-globe"></i> @lang('bt.public')</a>--}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                   onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('purchaseorders.delete', [$purchaseorder->id]) }}');"><i
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
            <button type="button" class="btn btn-primary btn-save-purchaseorder"><i
                        class="fa fa-save"></i> @lang('bt.save')</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="#" class="btn-save-purchaseorder"
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
                <div class="col-sm-8" id="col-from">
                    @include('purchaseorders._edit_from')
                </div>
                <div class="col-sm-4" id="col-to">
                    @include('purchaseorders._edit_to')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">@lang('bt.summary')</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::text('summary', $purchaseorder->summary, ['id' => 'summary', 'class' => 'form-control']) !!}
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
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="item-table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">@lang('bt.product')</th>
                                    <th style="width: 25%;">@lang('bt.description')</th>
                                    <th style="width: 10%;">@lang('bt.qty')</th>
                                    <th style="width: 10%;">@lang('bt.product_cost')</th>
                                    <th style="width: 10%;">@lang('bt.tax_1')</th>
                                    <th style="width: 10%;">@lang('bt.tax_2')</th>
                                    <th style="width: 10%; text-align: right; padding-right: 25px;">@lang('bt.total')</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="new-item" style="display: none;">
                                    <td>
                                        {!! Form::hidden('purchaseorder_id', $purchaseorder->id) !!}
                                        {!! Form::hidden('id', '') !!}
                                        {!! Form::hidden('resource_table', '') !!}
                                        {!! Form::hidden('resource_id', '') !!}
                                        {{--change below from type text to search and add autocomplete = off to stop chrome from autofill suggestion--}}
                                        {!! Form::search('name', null, ['class' => 'form-control', 'title' => 'Autocomplete from Products', 'autocomplete' => 'off']) !!}<br>
                                        <label for="save_item_as_product"><input type="checkbox" name="save_item_as_product" tabindex="999"> @lang('bt.save_item_as_product')</label>

                                    </td>
                                    <td>{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                    <td>{!! Form::text('quantity', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::text('cost', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_id', $taxRates, config('bt.itemTaxRate'), ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_2_id', $taxRates, config('bt.itemTax2Rate'), ['class' => 'form-control']) !!}</td>
                                    <td></td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary btn-delete-new-item"
                                           href="javascript:void(0);"
                                           title="@lang('bt.trash')" >
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @foreach ($purchaseorder->items as $item)
                                    <tr class="item" id="tr-item-{{ $item->id }}">
                                        <td>
                                            {!! Form::hidden('purchaseorder_id', $purchaseorder->id) !!}
                                            {!! Form::hidden('id', $item->id) !!}
                                            {!! Form::hidden('resource_table', $item->resource_table) !!}
                                            {!! Form::hidden('resource_id', $item->resource_id) !!}
                                            {!! Form::text('name', $item->name, ['class' => 'form-control item-lookup']) !!}
                                        </td>
                                        <td>{!! Form::textarea('description', $item->description, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                        <td>{!! Form::text('quantity', $item->formatted_quantity, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::text('cost', $item->formatted_numeric_cost, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::select('tax_rate_id', $taxRates, $item->tax_rate_id, ['class' => 'form-control']) !!}</td>
                                        <td>{!! Form::select('tax_rate_2_id', $taxRates, $item->tax_rate_2_id, ['class' => 'form-control']) !!}</td>
                                        <td style="text-align: right; padding-right: 25px;">{{ $item->amount->formatted_subtotal }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary btn-delete-purchaseorder-item"
                                               href="javascript:void(0);"
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
                                <li class="nav-item"><a class="nav-link active show" href="#tab-additional"
                                                        data-toggle="tab">@lang('bt.additional')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-notes"
                                                        data-toggle="tab">@lang('bt.notes')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-attachments"
                                                        data-toggle="tab">@lang('bt.attachments')</a></li>
                                {{--                            <li class="nav-item"><a class="nav-link" href="#tab-payments"--}}
                                {{--                                                    data-toggle="tab">@lang('bt.payments')</a></li>--}}
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-additional">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('bt.terms_and_conditions')</label>
                                                {!! Form::textarea('terms', $purchaseorder->terms, ['id' => 'terms', 'class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('bt.footer')</label>
                                                {!! Form::textarea('footer', $purchaseorder->footer, ['id' => 'footer', 'class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if ($customFields->count())
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('custom_fields._custom_fields_unbound', ['object' => $purchaseorder])
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab-notes">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('notes._notes', ['object' => $purchaseorder, 'model' => 'BT\Modules\Purchaseorders\Models\Purchaseorder', 'showPrivateCheckbox' => true, 'hideHeader' => true])
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-attachments">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('attachments._table', ['object' => $purchaseorder, 'model' => 'BT\Modules\Purchaseorders\Models\Purchaseorder'])
                                        </div>
                                    </div>
                                </div>
                                {{--                            <div class="tab-pane" id="tab-payments">--}}
                                {{--                                <table class="table table-hover">--}}

                                {{--                                    <thead>--}}
                                {{--                                    <tr>--}}
                                {{--                                        <th>@lang('bt.payment_date')</th>--}}
                                {{--                                        <th>@lang('bt.amount')</th>--}}
                                {{--                                        <th>@lang('bt.payment_method')</th>--}}
                                {{--                                        <th>@lang('bt.note')</th>--}}
                                {{--                                    </tr>--}}
                                {{--                                    </thead>--}}

                                {{--                                    <tbody>--}}
                                {{--                                    @foreach ($purchaseorder->payments as $payment)--}}
                                {{--                                        <tr>--}}
                                {{--                                            <td>{{ $payment->formatted_paid_at }}</td>--}}
                                {{--                                            <td>{{ $payment->formatted_amount }}</td>--}}
                                {{--                                            <td>@if ($payment->paymentMethod) {{ $payment->paymentMethod->name }} @endif</td>--}}
                                {{--                                            <td>{{ $payment->note }}</td>--}}
                                {{--                                        </tr>--}}
                                {{--                                    @endforeach--}}
                                {{--                                    </tbody>--}}

                                {{--                                </table>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div id="div-totals">
                @include('purchaseorders._edit_totals')
            </div>
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">@lang('bt.options')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('bt.purchaseorder') #</label>
                        {!! Form::text('number', $purchaseorder->number, ['id' => 'number', 'class' =>
                        'form-control
                        form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.date')</label>
                        {!! Form::text('purchaseorder_date', $purchaseorder->formatted_purchaseorder_date, ['id' =>
                        'purchaseorder_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.due_date')</label>
                        {!! Form::text('due_at', $purchaseorder->formatted_due_at, ['id' => 'due_at', 'class'
                        => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.discount')</label>
                        <div class="input-group input-group-sm">
                            {!! Form::text('discount', $purchaseorder->formatted_numeric_discount, ['id' =>
                            'discount', 'class' => 'form-control form-control-sm']) !!}
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.currency')</label>
                        {!! Form::select('currency_code', $currencies, $purchaseorder->currency_code, ['id' =>
                        'currency_code', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.exchange_rate')</label>
                        <div class="input-group">
                            {!! Form::text('exchange_rate', $purchaseorder->exchange_rate, ['id' =>
                            'exchange_rate', 'class' => 'form-control form-control-sm']) !!}
                            <span class="input-group-append">
                                <button class="btn btn-sm" id="btn-update-exchange-rate" type="button"
                                        data-toggle="tooltip" data-placement="left"
                                        title="@lang('bt.update_exchange_rate')"><i class="fa fa-sync"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.status')</label>
                        {!! Form::select('purchaseorder_status_id', $statuses, $purchaseorder->purchaseorder_status_id,
                        ['id' => 'purchaseorder_status_id', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.template')</label>
                        {!! Form::select('template', $templates, $purchaseorder->template,
                        ['id' => 'template', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
