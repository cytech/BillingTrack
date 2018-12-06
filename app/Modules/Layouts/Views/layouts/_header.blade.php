<nav class="main-header navbar navbar-expand navbar-{{ $headClass }} bg-{{ $headBackground }} border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"
                ></i></a>
        </li>
    </ul>
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
    <div class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="@lang('fi.utilities')">
                <i class="fa fa-toolbox"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('employees.index') }}"><i
                            class="fa fa-users"></i> @lang('fi.employees')</a>
                <a class="dropdown-item" href="{{ route('products.index') }}"><i
                            class="fa fa-shopping-cart"></i> @lang('fi.products')</a>
                <a class="dropdown-item" href="{{ route('itemLookups.index') }}"><i
                            class="fa fa-eye"></i> @lang('fi.item_lookups')</a>
                <a class="dropdown-item" href="{{ route('mailLog.index') }}"><i
                            class="fa fa-envelope-square"></i> @lang('fi.mail_log')</a>
                <a class="dropdown-item" href="{{ route('utilities.batchprint') }}"><i
                            class="fa fa-print"></i> @lang('fi.batchprint')</a>
                <a class="dropdown-item" href="{{ route('utilities.manage_trash') }}"><i
                            class="fa fa-trash"></i> @lang('fi.manage_trash')</a>


            </div>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="@lang('fi.system')">
                <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('addons.index') }}">@lang('fi.addons')</a>
                <a class="dropdown-item" href="{{ route('currencies.index') }}">@lang('fi.currencies')</a>
                <a class="dropdown-item" href="{{ route('customFields.index') }}">@lang('fi.custom_fields')</a>
                <a class="dropdown-item"
                   href="{{ route('companyProfiles.index') }}">@lang('fi.company_profiles')</a>
                <a class="dropdown-item" href="{{ route('export.index') }}">@lang('fi.export_data')</a>
                <a class="dropdown-item" href="{{ route('groups.index') }}">@lang('fi.groups')</a>
                <a class="dropdown-item" href="{{ route('import.index') }}">@lang('fi.import_data')</a>
                <a class="dropdown-item"
                   href="{{ route('paymentMethods.index') }}">@lang('fi.payment_methods')</a>
                <a class="dropdown-item" href="{{ route('taxRates.index') }}">@lang('fi.tax_rates')</a>
                <a class="dropdown-item" href="{{ route('users.index') }}">@lang('fi.user_accounts')</a>
                <a class="dropdown-item" href="{{ route('settings.index') }}">@lang('fi.system_settings')</a>
                @foreach (config('fi.menus.system') as $menu)
                    @if (view()->exists($menu))
                        @include($menu)
                    @endif
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            {{--<a class="nav-link" href="/documentation" title="@lang('fi.documentation')"--}}
            <a class="nav-link" href="{{ url('documentation', ['Requirements']) }}"
               title="@lang('fi.documentation')"
               aria-haspopup="true" aria-expanded="false" target="_blank">
                <i class="fa fa-question-circle"></i>
            </a>
        </li>

        <li class="nav-item">

            <a class="nav-link" href="{{ route('session.logout') }}" title="@lang('fi.sign_out')"
               aria-haspopup="true" aria-expanded="false"><i
                        class="fa fa-power-off"></i></a>
        </li>

    </div>

</nav>

{{--</header>--}}