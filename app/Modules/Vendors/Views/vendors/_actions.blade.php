<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
        @lang('fi.options')
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
        <a class="dropdown-item" href="{{ route('vendors.show', [$id]) }}" id="view-vendor-{{ $id }}"><i
                        class="fa fa-search"></i> @lang('fi.view')</a>
        <a class="dropdown-item" href="{{ route('vendors.edit', [$id]) }}" id="edit-vendor-{{ $id }}"><i
                        class="fa fa-edit"></i> @lang('fi.edit')</a>
        <a href ="javascript:void(0)" class="create-purchaseorder dropdown-item" data-name="{{ $name }}"><i
                        class="far fa-file-alt"></i> @lang('fi.create_purchaseorder')</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" id="delete-vendor-{{ $id }}"
               onclick="swalConfirm('@lang('fi.trash_vendor_warning')', '{{ route('vendors.delete', [$id]) }}');"><i
                        class="fa fa-trash-alt"></i> @lang('fi.trash')</a>
    </div>
</div>
