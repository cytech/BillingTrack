<table id="dt-timesheetstable" class="display" cellspacing="0" width="100%">

    <thead>
    <tr>
        <th>{!! trans('fi.invoicenumber') !!}</th>
        <th>{!! trans('fi.customername') !!}</th>
        <th>{!! trans('fi.datefinished') !!}</th>
        <th>{!! trans('fi.itemname') !!}</th>
        <th>{!! trans('fi.itemqty') !!}</th>
        <th>{!! trans('fi.fullname') !!}</th>
        <th>{!! trans('fi.empnumber') !!}</th>
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
<h3>{!! trans('fi.totalhours') !!} = {{ $totalhours }}</h3>

{{--@include('partials._js_datatables')--}}