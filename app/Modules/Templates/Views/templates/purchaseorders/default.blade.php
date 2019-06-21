<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('bt.purchaseorder') #{{ $purchaseorder->number }}</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            color: #001028;
            background: #FFFFFF;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 12px;
            margin-bottom: 10px;
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
        }

        th, .section-header {
            padding: 5px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
            text-align: center;
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

        .terms {
            padding: 10px;
            text-align: center;
        }

        .footer {
            position: fixed;
            height: 50px;
            width: 100%;
            bottom: 0;
            text-align: center;
        }

    </style>
</head>
<body>

<table>
    <tr>
        <td style="width: 50%;" valign="top">
            <h1>{{ mb_strtoupper(trans('bt.purchaseorder')) }}</h1>
            <span class="info">{{ mb_strtoupper(trans('bt.purchaseorder')) }} #</span>{{ $purchaseorder->number }}<br>
            <span class="info">{{ mb_strtoupper(trans('bt.issued')) }}</span> {{ $purchaseorder->formatted_created_at }}
            <br>
            <span class="info">{{ mb_strtoupper(trans('bt.due_date')) }}</span> {{ $purchaseorder->formatted_due_at }}
            <br><br>
            <span class="info">{{ mb_strtoupper(trans('bt.to')) }}</span><br>{{ $purchaseorder->vendor->name }}<br>
            @if ($purchaseorder->vendor->address) {!! $purchaseorder->vendor->formatted_address !!}<br>@endif
        </td>
        <td style="width: 50%; text-align: right;" valign="top">
            <span class="info">{{ mb_strtoupper(trans('bt.bill_to')) }}</span>
            {!! $purchaseorder->companyProfile->logo() !!}<br>
            {{ $purchaseorder->companyProfile->company }}<br>
            {!! $purchaseorder->companyProfile->formatted_address !!}<br>
            @if ($purchaseorder->companyProfile->phone) {{ $purchaseorder->companyProfile->phone }}<br>@endif
            @if ($purchaseorder->user->email) <a
                    href="mailto:{{ $purchaseorder->user->email }}">{{ $purchaseorder->user->email }}</a>@endif
            <br><br><br>
            @if ($purchaseorder->companyProfile->address_2)
                <span class="info">{{ mb_strtoupper(trans('bt.ship_to')) }}</span><br>
                {{ $purchaseorder->companyProfile->company }}<br>
                {!! $purchaseorder->companyProfile->formatted_address2 !!}<br>
            @endif

        </td>
    </tr>
</table>

<table class="alternate">
    <thead>
    <tr>
        <th>{{ mb_strtoupper(trans('bt.product')) }}</th>
        <th>{{ mb_strtoupper(trans('bt.description')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('bt.quantity')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('bt.product_cost')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('bt.total')) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($purchaseorder->items as $item)
        <tr>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->formatted_description !!}</td>
            <td nowrap class="amount">{{ $item->formatted_quantity }}</td>
            <td nowrap class="amount">{{ $item->formatted_cost }}</td>
            <td nowrap class="amount">{{ $item->amount->formatted_subtotal }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('bt.subtotal')) }}</td>
        <td class="amount">{{ $purchaseorder->amount->formatted_subtotal }}</td>
    </tr>

    @if ($purchaseorder->discount > 0)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper(trans('bt.discount')) }}</td>
            <td class="amount">{{ $purchaseorder->amount->formatted_discount }}</td>
        </tr>
    @endif

    @foreach ($purchaseorder->summarized_taxes as $tax)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper($tax->name) }} ({{ $tax->percent }})</td>
            <td class="amount">{{ $tax->total }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('bt.total')) }}</td>
        <td class="amount">{{ $purchaseorder->amount->formatted_total }}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('bt.paid')) }}</td>
        <td class="amount">{{ $purchaseorder->amount->formatted_paid }}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('bt.balance')) }}</td>
        <td class="amount">{{ $purchaseorder->amount->formatted_balance }}</td>
    </tr>
    </tbody>
</table>

@if ($purchaseorder->terms)
    <div class="section-header">{{ mb_strtoupper(trans('bt.terms_and_conditions')) }}</div>
    <div class="terms">{!! $purchaseorder->formatted_terms !!}</div>
    <br>
@endif

<div class="footer"> {!! $purchaseorder->formatted_footer !!}</div>

</body>
</html>
