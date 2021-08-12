<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('bt.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('vendors.show', [$id]) }}" id="view-vendor-{{ $id }}"><i
                        class="fa fa-search"></i> @lang('bt.view')</a>
        <a class="dropdown-item" href="{{ route('vendors.edit', [$id]) }}" id="edit-vendor-{{ $id }}"><i
                        class="fa fa-edit"></i> @lang('bt.edit')</a>
        <a href ="javascript:void(0)" class="create-purchaseorder dropdown-item" data-name="{{ $name }}"><i
                        class="far fa-file-alt"></i> @lang('bt.create_purchaseorder')</a>
{{--        <div class="dropdown-divider"></div>--}}
{{--        <a class="dropdown-item" href="#" id="delete-vendor-{{ $id }}"--}}
{{--               onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('vendors.delete', [$id]) }}');"><i--}}
{{--                        class="fa fa-trash-alt"></i> @lang('bt.delete')</a>--}}
    </div>
</div>
