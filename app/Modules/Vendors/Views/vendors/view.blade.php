@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.view_vendor')
        </h3>
        <div class="float-right">
            <a href ="javascript:void(0)" class="create-purchaseorder btn btn-secondary" data-name="{{ $vendor->name }}"><i
                        class="far fa-file-alt"></i> @lang('bt.create_purchaseorder')</a>
            <a href="{{ $returnUrl }}" class="btn btn-secondary"><i class="fa fa-backward"></i> @lang('bt.back')</a>
            <a href="{{ route('vendors.edit', [$vendor->id]) }}" class="btn btn-secondary">@lang('bt.edit')</a>
{{--            <a class="btn btn-secondary" href="#"--}}
{{--               onclick="swalConfirm('@lang('bt.trash_vendor_warning')', '@lang('bt.trash_vendor_warning_msg')', '{{ route('vendors.delete', [$vendor->id]) }}');"><i--}}
{{--                        class="fa fa-trash"></i> @lang('bt.trash')</a>--}}
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">
            <div class="col-12">
                <div class="card m-2">

                    <div class="card-header d-flex p-0">
                        <ul class="nav nav-tabs p-2">
                            <li class="nav-item "><a class="nav-link active show" data-toggle="tab"
                                                     href="#tab-details">@lang('bt.details')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-purchaseorders">@lang('bt.purchaseorders')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-attachments">@lang('bt.attachments')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-notes">@lang('bt.notes')</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div id="tab-details" class="tab-pane active">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="float-left mb-3">
                                            <h2>{!! $vendor->name !!}</h2>
                                            @lang('bt.payment_terms'):&nbsp;&nbsp;
                                            @if($vendor->paymentterm->id != 1)
                                                {{$vendor->paymentterm->name}}
                                            @else
                                                @lang('bt.default_terms')
                                            @endif
                                        </div>

{{--                                        <div class="float-right" style="text-align: right;">--}}
{{--                                            <p>--}}
{{--                                                <strong>@lang('bt.total_billed')--}}
{{--                                                    :</strong> {{ $vendor->formatted_total }}<br/>--}}
{{--                                                <strong>@lang('bt.total_paid'):</strong> {{ $vendor->formatted_paid }}--}}
{{--                                                <br/>--}}
{{--                                                <strong>@lang('bt.total_balance')--}}
{{--                                                    :</strong> {{ $vendor->formatted_balance }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <table class="table table-striped">
                                            <tr class="row">
                                                <td class="col-md-2">@lang('bt.billing_address')</td>
                                                <td class="table-bordered col-md-4">{!! $vendor->formatted_address !!}</td>
                                                <td class="col-md-2">@lang('bt.shipping_address')</td>
                                                <td class="table-bordered col-md-4">{!! $vendor->formatted_address2 !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('bt.email')</td>
                                                <td class="col-md-10"><a
                                                            href="mailto:{!! $vendor->email !!}">{!! $vendor->email !!}</a>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-1">@lang('bt.phone')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->phone !!}</td>


                                                <td class="col-md-1">@lang('bt.mobile')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->mobile !!}</td>


                                                <td class="col-md-1">@lang('bt.fax')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->fax !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('bt.web')</td>
                                                <td class="col-md-10"><a href="{!! $vendor->web !!}"
                                                                         target="_blank">{!! $vendor->web !!}</a></td>
                                            </tr>
                                            @foreach ($customFields as $customField)
                                                <tr class="row">
                                                    <td class="col-md-2">{!! $customField->field_label !!}</td>
                                                    <td class="col-md-10">
                                                        @if (isset($vendor->custom->{$customField->column_name}))
                                                            {!! nl2br($vendor->custom->{$customField->column_name}) !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <h2>@lang('bt.contacts')</h2>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-contacts">
                                @include('vendors._contacts', ['contacts' => $vendor->contacts()->orderBy('name')->get(), 'vendorId' => $vendor->id])
                                </div>
                            </div>
                            <div id="tab-purchaseorders" class="tab-pane">
                                <div class="card">
                                    @include('purchaseorders._table')
                                    <div class="card-footer"><p class="text-center"><strong><a
                                                        href="{{ route('purchaseorders.index') }}?vendor={{ $vendor->id }}">@lang('bt.view_all')</a></strong>
                                        </p></div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-attachments">
                                @include('attachments._table', ['object' => $vendor, 'model' => 'BT\Modules\Vendors\Models\Vendor'])
                            </div>

                            <div id="tab-notes" class="tab-pane">
                                @include('notes._notes', ['object' => $vendor, 'model' => 'BT\Modules\Vendors\Models\Vendor', 'hideHeader' => true])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@stop
