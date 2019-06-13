@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('fi.view_vendor')
        </h3>
        <div class="float-right">
            <a href="{{ $returnUrl }}" class="btn btn-secondary"><i class="fa fa-backward"></i> @lang('fi.back')</a>
            <a href="{{ route('vendors.edit', [$vendor->id]) }}" class="btn btn-secondary">@lang('fi.edit')</a>
            <a class="btn btn-secondary" href="#"
               onclick="swalConfirm('@lang('fi.trash_vendor_warning')', '{{ route('vendors.delete', [$vendor->id]) }}');"><i
                        class="fa fa-trash"></i> @lang('fi.trash')</a>
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
                                                     href="#tab-details">@lang('fi.details')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-attachments">@lang('fi.attachments')</a></li>
                            <li class="nav-item "><a class="nav-link" data-toggle="tab"
                                                     href="#tab-notes">@lang('fi.notes')</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div id="tab-details" class="tab-pane active">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="float-left mb-3">
                                            <h2>{!! $vendor->name !!}</h2>
                                            @lang('fi.payment_terms'):&nbsp;&nbsp;
                                            @if($vendor->paymentterm->id != 1)
                                                {{$vendor->paymentterm->name}}
                                            @else
                                                @lang('fi.default_terms')
                                            @endif
                                        </div>

{{--                                        <div class="float-right" style="text-align: right;">--}}
{{--                                            <p>--}}
{{--                                                <strong>@lang('fi.total_billed')--}}
{{--                                                    :</strong> {{ $vendor->formatted_total }}<br/>--}}
{{--                                                <strong>@lang('fi.total_paid'):</strong> {{ $vendor->formatted_paid }}--}}
{{--                                                <br/>--}}
{{--                                                <strong>@lang('fi.total_balance')--}}
{{--                                                    :</strong> {{ $vendor->formatted_balance }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <table class="table table-striped">
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.billing_address')</td>
                                                <td class="table-bordered col-md-4">{!! $vendor->formatted_address !!}</td>
                                                <td class="col-md-2">@lang('fi.shipping_address')</td>
                                                <td class="table-bordered col-md-4">{!! $vendor->formatted_address2 !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.email')</td>
                                                <td class="col-md-10"><a
                                                            href="mailto:{!! $vendor->email !!}">{!! $vendor->email !!}</a>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-1">@lang('fi.phone')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->phone !!}</td>


                                                <td class="col-md-1">@lang('fi.mobile')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->mobile !!}</td>


                                                <td class="col-md-1">@lang('fi.fax')</td>
                                                <td class="table-bordered col-md-3">{!! $vendor->fax !!}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-md-2">@lang('fi.web')</td>
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
                                            <h2>@lang('fi.contacts')</h2>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-contacts">
                                @include('vendors._contacts', ['contacts' => $vendor->contacts()->orderBy('name')->get(), 'vendorId' => $vendor->id])
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
