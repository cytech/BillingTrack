@include('workorders.partials._js_edit')

<section class="content-header">
    <h3 class="float-left">@lang('bt.workorder') #{{ $workorder->number }}</h3>

    @if ($workorder->viewed)
        <span style="margin-left: 10px;" class="badge badge-success">@lang('bt.viewed')</span>
    @else
        <span style="margin-left: 10px;" class="badge badge-secondary">@lang('bt.not_viewed')</span>
    @endif

    @if ($workorder->invoice()->count())
        @if($workorder->invoice->status_text == 'canceled')
            <span class="badge badge-canceled" title="@lang('bt.canceled')"><a href="{{ route('invoices.edit', [$workorder->invoice_id]) }}"
                                              style="color: inherit;">@lang('bt.converted_to_invoice') {{ $workorder->invoice->number }}</a></span>
        @else
        <span class="badge badge-info"><a href="{{ route('invoices.edit', [$workorder->invoice_id]) }}"
                                          style="color: inherit;">@lang('bt.converted_to_invoice') {{ $workorder->invoice->number }}</a></span>
        @endif
    @elseif ($workorder->invoice()->withTrashed()->count())
        <span class="badge badge-danger" title="Trashed">@lang('bt.converted_to_invoice') {{ $workorder->invoice_id }}</span>
    @endif

    @if ($workorder->quote()->count())
        <span class="badge badge-info"><a href="{{ route('quotes.edit', [$workorder->quote->id]) }}" style="color: inherit;">@lang('bt.converted_from_quote') {{ $workorder->quote->number }}</a></span>
    @endif

    <div class="float-right">

        <a href="{{ route('workorders.pdf', [$workorder->id]) }}" target="_blank" id="btn-pdf-workorder"
           class="btn btn-secondary"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
        {{-- removed email button from workorders, there should not be emailing a customer a workorder, only a quote or invoice --}}
        {{--@if (config('bt.mailConfigured'))
            <a href="javascript:void(0)" id="btn-email-workorder" class="btn btn-secondary email-workorder"
               data-workorder-id="{{ $workorder->id }}" data-redirect-to="{{ route('workorders.edit', [$workorder->id]) }}"><i
                        class="fa fa-envelope"></i> @lang('bt.email')</a>
        @endif--}}

        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                @lang('bt.other')
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" id="btn-copy-workorder"><i
                            class="fa fa-copy"></i> @lang('bt.copy_workorder')</a>
                <a class="dropdown-item" href="javascript:void(0)" id="btn-workorder-to-invoice"><i
                            class="fa fa-check"></i> @lang('bt.workorder_to_invoice')</a>
                <div class="dropdown-divider"></div>

                @if($workorder->quote)
                    <a class="dropdown-item" href="#"
                       onclick="swalConfirm('@lang('bt.trash_record_warning')','@lang('bt.trash_workorder_warning_assoc_msg')', '{{ route('workorders.delete', [$workorder->id]) }}');"><i
                                class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                @else
                    <a class="dropdown-item" href="#"
                       onclick="swalConfirm('@lang('bt.trash_record_warning')', '', '{{ route('workorders.delete', [$workorder->id]) }}');"><i
                                class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                @endif
            </div>
        </div>

        <div class="btn-group">
            @if ($returnUrl)
                <a href="{{ $returnUrl }}" class="btn btn-secondary"><i
                            class="fa fa-backward"></i> @lang('bt.back')</a>
            @endif
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-save-workorder"><i
                        class="fa fa-save"></i> @lang('bt.save')</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">

            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a class="dropdown-item" href="#" class="btn-save-workorder"
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
                            <h3 class="card-title">@lang('bt.summary')</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::text('summary', $workorder->summary, ['id' => 'summary', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-5 text-right text">@lang('bt.job_date')</label>
                    <div class="col-sm-7">
                    {!! Form::text('job_date', $workorder->formatted_job_date, ['id' =>
                    'job_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="start_time" class="col-sm-5 text-right text">@lang('bt.start_time')</label>
                    <div class="col-sm-7">
                    {!! Form::text('start_time', $workorder->formatted_start_time, ['id' =>
                    'start_time', 'class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="end_time" class="col-sm-5 text-right text">@lang('bt.end_time')</label>
                    <div class="col-sm-7">
                    {!! Form::text('end_time', $workorder->formatted_end_time, ['id' =>
                    'end_time', 'class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-7 text-right text">@lang('bt.will_call')</label>
                    <div class="col-sm-5">
                        {!! Form::checkbox('will_call', 1, $workorder->will_call, ['id' => 'will_call']) !!}
                        <script>
                            document.getElementById('will_call').switchButton({
                                onlabel: '@lang('bt.yes')',
                                offlabel: '@lang('bt.no')',
                                onstyle: 'success',
                                offstyle: 'danger',
                                size: 'sm'
                            });
                        </script>
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
                                        {!! Form::hidden('workorder_id', $workorder->id) !!}
                                        {!! Form::hidden('id', '') !!}
                                        {!! Form::hidden('resource_table', '') !!}
                                        {!! Form::hidden('resource_id', '') !!}
                                        {!! Form::search('name', null, ['class' => 'form-control', 'title' => 'Autocomplete from Item Lookups', 'autocomplete' => "off"]) !!}<br>
                                        <label for="save_item_as_lookup"><input type="checkbox" name="save_item_as_lookup"
                                                      tabindex="999"> @lang('bt.save_item_as_lookup')</label>
                                    </td>
                                    <td>{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 1]) !!}</td>
                                    <td>{!! Form::text('quantity', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::text('price', null, ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_id', $taxRates, config('bt.itemTaxRate'), ['class' => 'form-control']) !!}</td>
                                    <td>{!! Form::select('tax_rate_2_id', $taxRates, config('bt.itemTax2Rate'), ['class' => 'form-control']) !!}</td>
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
                                               title="@lang('bt.delete')" data-item-id="{{ $item->id }}">
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
                            <li class="nav-item"><a class="nav-link" href="#tab-notes" data-toggle="tab">@lang('bt.notes')</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-attachments" data-toggle="tab">@lang('bt.attachments')</a></li>
                        </ul>
                        </div>
                        <div class="card-body">

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-additional">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                         <label>@lang('bt.terms_and_conditions')</label>
                                         {!! Form::textarea('terms', $workorder->terms, ['id' => 'terms', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('bt.footer')</label>
                                            {!! Form::textarea('footer', $workorder->footer, ['id' => 'footer', 'class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-notes">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('notes._notes', ['object' => $workorder, 'model' => 'BT\Modules\Workorders\Models\Workorder', 'showPrivateCheckbox' => true, 'hideHeader' => true])
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-attachments">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('attachments._table', ['object' => $workorder, 'model' => 'BT\Modules\Workorders\Models\Workorder'])
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
                    <h3 class="card-title">@lang('bt.options')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('bt.workorder') #</label>
                        {!! Form::text('number', $workorder->number, ['id' => 'number', 'class' =>
                        'form-control
                        form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.date')</label>
                        {!! Form::text('workorder_date', $workorder->formatted_workorder_date, ['id' =>
                        'workorder_date', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.status')</label>
                        {!! Form::select('workorder_status_id', $statuses, $workorder->workorder_status_id,
                        ['id' => 'workorder_status_id', 'class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('bt.expires')</label>
                        {!! Form::text('expires_at', $workorder->formatted_expires_at, ['id' => 'expires_at', 'class'
                        => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.discount')</label>
                        <div class="input-group input-group-sm">
                            {!! Form::text('discount', $workorder->formatted_numeric_discount, ['id' =>
                            'discount', 'class' => 'form-control form-control-sm']) !!}
                            <div class="input-group-append">
                            <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.currency')</label>
                        {!! Form::select('currency_code', $currencies, $workorder->currency_code, ['id' =>
                        'currency_code', 'class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('bt.exchange_rate')</label>

                        <div class="input-group">
                            {!! Form::text('exchange_rate', $workorder->exchange_rate, ['id' =>
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
                        <label>@lang('bt.template')</label>
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
