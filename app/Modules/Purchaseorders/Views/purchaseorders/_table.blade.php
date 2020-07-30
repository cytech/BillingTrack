<table class="table table-hover">

    <thead>
    <tr>
{{--        <th><div class="btn-group"><input type="checkbox" id="bulk-select-all"></div></th>--}}
        <th>@lang('bt.status')</th>
        <th>@lang('bt.purchaseorder')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.due')</th>
        <th>@lang('bt.vendor')</th>
        <th>@lang('bt.summary')</th>
        <th style="text-align: right; padding-right: 25px;">@lang('bt.total')</th>
        <th style="text-align: right; padding-right: 25px;">@lang('bt.balance')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($purchaseorders as $purchaseorder)
        <tr>
{{--            <td><input type="checkbox" class="bulk-record" data-id="{{ $purchaseorder->id }}"></td>--}}
            <td>
                <span class="badge badge-{{ $statuses[$purchaseorder->purchaseorder_status_id] }}">{{ trans('bt.' . $statuses[$purchaseorder->purchaseorder_status_id]) }}</span>
{{--                @if ($purchaseorder->viewed)--}}
{{--                    <span class="badge badge-success">@lang('bt.viewed')</span>--}}
{{--                @else--}}
{{--                    <span class="badge badge-secondary">@lang('bt.not_viewed')</span>--}}
{{--                @endif--}}
            </td>
            <td><a href="{{ route('purchaseorders.edit', [$purchaseorder->id]) }}"
                   title="@lang('bt.edit')">{{ $purchaseorder->number }}</a></td>
            <td>{{ $purchaseorder->formatted_purchaseorder_date }}</td>
            <td @if ($purchaseorder->isOverdue) style="color: red; font-weight: bold;" @endif>{{ $purchaseorder->formatted_due_at }}</td>
            <td><a href="{{ route('vendors.show', [$purchaseorder->vendor->id]) }}"
                   title="@lang('bt.view_vendor')">{{ $purchaseorder->vendor->name }}</a></td>
            <td>{{ mb_strimwidth($purchaseorder->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $purchaseorder->amount->formatted_total }}</td>
            <td style="text-align: right; padding-right: 25px;">{{ $purchaseorder->amount->formatted_balance }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('purchaseorders.edit', [$purchaseorder->id]) }}"><i
                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                        <a class="dropdown-item" href="{{ route('purchaseorders.pdf', [$purchaseorder->id]) }}" target="_blank"
                               id="btn-pdf-purchaseorder"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a href="javascript:void(0)" class="email-purchaseorder dropdown-item" data-purchaseorder-id="{{ $purchaseorder->id }}"
                               data-redirect-to="{{ request()->fullUrl() }}"><i
                                    class="fa fa-envelope"></i> @lang('bt.email')</a>
{{--                        <a class="dropdown-item" href="{{ route('vendorCenter.public.purchaseorder.show', [$purchaseorder->url_key]) }}"--}}
{{--                               target="_blank" id="btn-public-purchaseorder"><i--}}
{{--                                    class="fa fa-globe"></i> @lang('bt.public')</a>--}}
{{--                        @if ($purchaseorder->isPayable or config('bt.allowPaymentsWithoutBalance'))--}}
{{--                            <a href="javascript:void(0)" id="btn-enter-payment" class="enter-payment dropdown-item"--}}
{{--                                   data-purchaseorder-id="{{ $purchaseorder->id }}"--}}
{{--                                   data-purchaseorder-balance="{{ $purchaseorder->amount->formatted_numeric_balance }}"--}}
{{--                                   data-redirect-to="{{ request()->fullUrl() }}"><i--}}
{{--                                        class="fa fa-credit-card"></i> @lang('bt.enter_payment')</a>--}}
{{--                        @endif--}}
                        <a class="dropdown-item" href="{{ route('purchaseorders.delete', [$purchaseorder->id]) }}"
                               onclick="return confirm('@lang('bt.trash_record_warning')');"><i
                                    class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
