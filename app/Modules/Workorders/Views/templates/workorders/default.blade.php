<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ trans('fi.workorder') }} #{{ $workorder->number }}</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            color: #001028;
            background: #FFFFFF;
            font-family : DejaVu Sans, Helvetica, sans-serif;
            font-size: 12px;
            margin-bottom: 50px;
        }

        a {
            color: #5D6975;
            border-bottom: 1px solid currentColor;
            text-decoration: none;
        }

        h1 {
            color: #5D6975;
            font-size: 2.8em;
            line-height: 1.4em;
            font-weight: bold;
            margin: 0;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        th {
            padding: 5px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        td {
            padding: 10px;
        }

        table.alternate tr:nth-child(odd) td {
            background: #F5F5F5;
        }

        th.amount, td.amount {
            text-align: right;
        }

        .info {
            color: #5D6975;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            height: 50px;
            width: 100%;
            bottom: 0px;
            text-align: center;
        }

    </style>
</head>
<body>

<table>
    <tr>
        <td style="width: 50%;" valign="top">
            <h1>{{ mb_strtoupper(trans('fi.workorder')) }}</h1>
                <span class="info">{{ mb_strtoupper(trans('fi.workorder')) }} #</span>{{ $workorder->number }}<br>
                <span class="info">{{ mb_strtoupper(trans('fi.issued')) }}</span> {{ $workorder->formatted_workorder_date }}<br>
                <span class="info">{{ mb_strtoupper(trans('fi.expires')) }}</span> {{ $workorder->formatted_expires_at }}<br><br>
                <span class="info">{{ mb_strtoupper(trans('fi.bill_to')) }}</span><br>{{ $workorder->client->name }}<br>
                @if ($workorder->client->address) {!! $workorder->client->formatted_address !!}<br>@endif
                @if ($workorder->client->phone) {!! $workorder->client->phone !!}<br>@endif
        </td>
        <td style="width: 50%; text-align: right;" valign="top">
            {!! $logo !!}<br>
            {{ $workorder->companyProfile->company }}<br>
            {!! $workorder->companyProfile->formatted_address !!}<br>
            @if ($workorder->companyProfile->phone) {{ $workorder->user->phone }}<br>@endif
            @if ($workorder->user->email) <a href="mailto:{{ $workorder->user->email }}">{{ $workorder->user->email }}</a><br>@endif
            <br>
            <span class="info">{{ 'Job Date: ' }}</span>{{ $workorder->formatted_job_date }}<br>
            <span class="info">{{ 'Start Time: ' }}</span>{{ $workorder->formatted_start_time }}<br>
            {{--<span class="info">{{ 'End Time: ' }}</span>{{ $workorder->formatted_end_time }}<br>--}}
            <span class="info">{{ 'Estimated Hours: ' }}</span>{{ $workorder->formatted_job_length }}<br>
            <span class="info">
                 @if ($workorder->will_call ==1)
                    <strong>Client Pickup: Yes</strong>
                @else
                    <strong>Client Pickup: No</strong>
                @endif
            </span>
        </td>
    </tr>

</table>

<table>
    <tr>
        <td style="width: 100%; text-align: left;" valign="top">
            <strong>Job Summary:</strong> {{$workorder->summary}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>

</table>

<table class="alternate">
    <thead>
    <tr>
        <th style="width:25%; text-align: left;">{{ mb_strtoupper(trans('fi.item')) }}</th>
        <th style="text-align: left;">{{ mb_strtoupper(trans('fi.description' )) }}</th>
        <th class="amount" width="10%">{{ mb_strtoupper(trans('fi.qty')) }}</th>
        <th class="amount" width="10%">{{ mb_strtoupper(trans('fi.price')) }}</th>
        <th class="amount" width="10%">{{ mb_strtoupper(trans('fi.total')) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($workorder->items as $item)
        <tr>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->formatted_description !!}</td>
            <td nowrap class="amount">{{ $item->formatted_quantity <> '0.00' ? $item->formatted_quantity : "________" }}</td>
            <td nowrap class="amount">{{ $item->formatted_numeric_price <> '0.00' ? $item->formatted_numeric_price : "________" }}</td>
            <td nowrap class="amount">{{ $item->amount->formatted_subtotal <> '$0.00' ? $item->amount->formatted_subtotal : "________" }}</td>
            {{--<td nowrap class="amount">{{ $item->quantity > 0 ? $item->quantity : "________" }}</td>--}}
            {{--<td nowrap class="amount">{{ $item->price > 0 ? $item->price : "________" }}</td>--}}
            {{--<td nowrap class="amount">{{ $item->amount->subtotal > 0 ? $item->amount->subtotal : "________" }}</td>--}}
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.subtotal')) }}</td>
        <td class="amount">__________</td>
    </tr>

    @if ($workorder->discount > 0)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.discount')) }}</td>
            <td class="amount">{{ $workorder->amount->formatted_discount }}</td>
        </tr>
    @endif

    @foreach ($workorder->summarized_taxes as $tax)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper($tax->name) }} ({{ $tax->percent }})</td>
            <td class="amount">{{ $tax->total }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.total')) }}</td>
        <td class="amount">__________</td>
    </tr>
    </tbody>
</table>

@if ($workorder->terms)
    <table style="margin-top: 50px;text-align: center" >
        <tr>
            <th>{{ mb_strtoupper(trans('fi.terms_and_conditions')) }}</th>
        </tr>
        <tr>
            <td align="center">{!! $workorder->formatted_terms !!}</td>
        </tr>
    </table>
@endif

{{-- footer class is causing issues in pdf generated with wkhtmltopdf --}}
<div align="center">{!! $workorder->formatted_footer !!}</div>

</body>
</html>