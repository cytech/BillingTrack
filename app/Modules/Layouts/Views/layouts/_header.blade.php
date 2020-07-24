<nav class="main-header navbar fixed-top navbar-expand navbar-{{ $headClass }} bg-{{ $headBackground }} border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"
                ></i></a>
        </li>
    </ul>
    @push('scripts')
    <script>
        //need to connect up scss bs4 themes...
        //style datatable header and btn-primary like the navbar
        const top_bar = $('.bg-{{ $headBackground }}');
        const bg = top_bar.css('background-color');
        let color = '#FFFFFF';
        // override white yellow and light gray color to black
        if (bg === 'rgb(255, 255, 255)' || bg === 'rgb(255, 237, 74)' || bg === 'rgb(242, 244, 245)'){
            color = '#000000';
        }

        const newStyles = document.createElement('style');
        document.head.append(newStyles);
        newStyles.innerHTML = ".btn-primary, .table.dataTable thead > tr > th {background-color: "
                                + bg + " !important; color: " + color + " !important;}";
    </script>
    @endpush
    <div class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="@lang('bt.utilities')">
                <i class="fa fa-toolbox"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('employees.index', ['status' => 'active']) }}"><i
                            class="fa fa-users"></i> @lang('bt.employees')</a>
                <a class="dropdown-item" href="{{ route('vendors.index', ['status' => 'active']) }}"><i
                            class="fa fa-warehouse"></i> @lang('bt.vendors')</a>
                <a class="dropdown-item" href="{{ route('products.index', ['status' => 'active']) }}"><i
                            class="fa fa-shopping-cart"></i> @lang('bt.products')</a>
                <a class="dropdown-item" href="{{ route('categories.index') }}"><i
                            class="fa fa-list"></i> @lang('bt.categories')</a>
                <a class="dropdown-item" href="{{ route('itemLookups.index') }}"><i
                            class="fa fa-eye"></i> @lang('bt.item_lookups')</a>
                <a class="dropdown-item" href="{{ route('mailLog.index') }}"><i
                            class="fa fa-envelope-square"></i> @lang('bt.mail_log')</a>
                <a class="dropdown-item" href="{{ route('utilities.batchprint') }}"><i
                            class="fa fa-print"></i> @lang('bt.batchprint')</a>
                <a class="dropdown-item" href="{{ route('utilities.manage_trash') }}"><i
                            class="fa fa-trash"></i> @lang('bt.manage_trash')</a>
                @if(!config('app.demo'))
                <a class="dropdown-item" href="{{ route('utilities.database') }}"><i
                            class="fa fa-save"></i> @lang('bt.database')</a>
                @endif
            </div>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="@lang('bt.system')">
                <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('addons.index') }}">@lang('bt.addons')</a>
                <a class="dropdown-item" href="{{ route('currencies.index') }}">@lang('bt.currencies')</a>
                <a class="dropdown-item" href="{{ route('customFields.index') }}">@lang('bt.custom_fields')</a>
                <a class="dropdown-item"
                   href="{{ route('companyProfiles.index') }}">@lang('bt.company_profiles')</a>
                <a class="dropdown-item" href="{{ route('export.index') }}">@lang('bt.export_data')</a>
                <a class="dropdown-item" href="{{ route('groups.index') }}">@lang('bt.groups')</a>
                <a class="dropdown-item" href="{{ route('import.index') }}">@lang('bt.import_data')</a>
                <a class="dropdown-item"
                   href="{{ route('paymentMethods.index') }}">@lang('bt.payment_methods')</a>
                <a class="dropdown-item" href="{{ route('taxRates.index') }}">@lang('bt.tax_rates')</a>
                <a class="dropdown-item" href="{{ route('users.index') }}">@lang('bt.user_accounts')</a>
                <a class="dropdown-item" href="{{ route('settings.index') }}">@lang('bt.system_settings')</a>
                @foreach (config('bt.menus.system') as $menu)
                    @if (view()->exists($menu))
                        @include($menu)
                    @endif
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            {{--<a class="nav-link" href="/documentation" title="@lang('bt.documentation')"--}}
            <a class="nav-link" href="{{ url('documentation', ['Overview']) }}"
               title="@lang('bt.documentation')"
               aria-haspopup="true" aria-expanded="false" target="_blank">
                <i class="fa fa-question-circle"></i>
            </a>
        </li>

        <li class="nav-item">

            <a class="nav-link" href="{{ route('session.logout') }}" title="@lang('bt.sign_out')"
               aria-haspopup="true" aria-expanded="false"><i
                        class="fa fa-power-off"></i></a>
        </li>

    </div>

</nav>

{{--</header>--}}
