@extends('reports.layouts.master')

@section('content')
    <table>
        <tr>
            <td style="width: 50%;" valign="top">
                @if( isset($results['client_name']))
                    <span style="font-weight: bold">{{ mb_strtoupper(trans('bt.bill_to')) }}</span><br>{{ $results['client_name'] }}<br>
                    @if ($results['client_address']) {!! $results['client_address'] !!}<br>@endif
                    @if ($results['client_city']) {!! $results['client_city'] !!}@endif
                    @if ($results['client_state']) {!! $results['client_state'] !!}@endif
                    @if ($results['client_zip']) {!! $results['client_zip'] !!}<br>@endif
                    @if ($results['client_phone']) {!! $results['client_phone'] !!}<br>@endif
                @else
                    <p> No results with current criteria </p>
                @endif
            </td>
            <td style="width: 50%; text-align: right;" valign="top">
                {{--{!! $logo !!}<br>--}}
                <span style="font-weight: bold">{{ $results['companyProfile_company'] }}</span><br>
                {!! $results['companyProfile_address'] !!}<br>
                {!! $results['companyProfile_city'] !!}
                {!! $results['companyProfile_state'] !!}
                {!! $results['companyProfile_zip' ]!!}<br>
                @if ($results['companyProfile_phone']) {{ $results['companyProfile_phone'] }}<br>@endif
            </td>
        </tr>
    </table>
    <h1 style="margin-bottom: 0;">@lang('bt.client_statement')</h1>
    <h3 style="margin-top: 0; margin-bottom: 0;">{{ $results['client_name'] }}</h3>
    <h3 style="margin-top: 0;">{{ $results['from_date'] }} - {{ $results['to_date'] }}</h3>
    <br>
    <table class="alternate">
        <thead>
        <tr>
            <th>@lang('bt.date')</th>
            <th>@lang('bt.invoice')</th>
            <th>@lang('bt.summary')</th>
            <th class="amount">@lang('bt.subtotal')</th>
            <th class="amount">@lang('bt.discount')</th>
            <th class="amount">@lang('bt.tax')</th>
            <th class="amount">@lang('bt.total')</th>
            <th class="amount">@lang('bt.paid')</th>
            <th class="amount">@lang('bt.balance')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results['records'] as $result)
            <tr>
                <td>{{ $result['formatted_invoice_date'] }}</td>
                <td>{{ $result['number'] }}</td>
                <td>{{ $result['summary'] }}</td>
                <td class="amount">{{ $result['formatted_subtotal'] }}</td>
                <td class="amount">{{ $result['formatted_discount'] }}</td>
                <td class="amount">{{ $result['formatted_tax'] }}</td>
                <td class="amount">{{ $result['formatted_total'] }}</td>
                <td class="amount">{{ $result['formatted_paid'] }}</td>
                <td class="amount">{{ $result['formatted_balance'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td class="amount" style="font-weight: bold;">{{ $results['subtotal'] }}</td>
            <td class="amount" style="font-weight: bold;">{{ $results['discount'] }}</td>
            <td class="amount" style="font-weight: bold;">{{ $results['tax'] }}</td>
            <td class="amount" style="font-weight: bold;">{{ $results['total'] }}</td>
            <td class="amount" style="font-weight: bold;">{{ $results['paid'] }}</td>
            <td class="amount" style="font-weight: bold;">{{ $results['balance'] }}</td>
        </tr>
        </tbody>
    </table>

@stop
