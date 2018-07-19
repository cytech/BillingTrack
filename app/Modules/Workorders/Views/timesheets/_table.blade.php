<table id="dt-timesheetstable" class="display" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('Workorders::texts.invoicenumber') !!}</th>
        <th>{!! trans('Workorders::texts.customername') !!}</th>
        <th>{!! trans('Workorders::texts.datefinished') !!}</th>
        <th>{!! trans('Workorders::texts.itemname') !!}</th>
        <th>{!! trans('Workorders::texts.itemqty') !!}</th>
        <th>{!! trans('Workorders::texts.fullname') !!}</th>
        <th>{!! trans('Workorders::texts.empnumber') !!}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->InvoiceNumber }}</td>
            <td class="hidden-xs">{{ $invoice->CustomerName }}</td>
            <td class="hidden-sm hidden-xs">{{ $invoice->DateFinished }}</td>
            <td class="hidden-sm hidden-xs">{{ $invoice->ItemName }}</td>
            <td class="hidden-sm hidden-xs">{{ $invoice->ItemQty }}</td>
            <td class="hidden-sm hidden-xs">{{ $invoice->FullName }}</td>
            <td class="hidden-sm hidden-xs">{{ $invoice->EmpNumber }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h3>{!! trans('Workorders::texts.totalhours') !!} = {{ $totalhours }}</h3>

{{--@include('Workorders::partials._js_datatables')--}}