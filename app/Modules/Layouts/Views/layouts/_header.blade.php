<nav class="main-header navbar navbar-expand navbar-{{ $headClass }} bg-{{ $headBackground }} border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"
                ></i></a>
        </li>
    </ul>
    <script>
        //need to connect up scss themes...
        //style datatable header and btn-primary like the navbar
        var top_bar = $('.bg-{{ $headBackground }}');
        var bg = top_bar.css('background-color');
        {{--var top_bar_text = $('.navbar-{{ $headClass }}');--}}
        // var color = top_bar_text.css('color');
        var color = '#FFFFFF';

        if (bg === 'rgb(255, 255, 255)' || bg === 'rgb(255, 237, 74)' || bg === 'rgb(242, 244, 245)'){
            color = '#000000';
        }

        var newStyles = document.createElement('style');
        document.head.append(newStyles);
        newStyles.innerHTML = ".btn-primary, .table.dataTable thead > tr > th {background-color: "
                                + bg + " !important; color: " + color + " !important;}";
    </script>
    <div class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.utilities') }}">
                <i class="fa fa-toolbox"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('employees.index') }}"><i
                            class="fa fa-users"></i> {{ trans('fi.employees') }}</a>
                <a class="dropdown-item" href="{{ route('products.index') }}"><i
                            class="fa fa-shopping-cart"></i> {{ trans('fi.products') }}</a>
                <a class="dropdown-item" href="{{ route('itemLookups.index') }}"><i
                            class="fa fa-eye"></i> {{ trans('fi.item_lookups') }}</a>
                <a class="dropdown-item" href="{{ route('mailLog.index') }}"><i
                            class="fa fa-envelope-square"></i> {{ trans('fi.mail_log') }}</a>
                <a class="dropdown-item" href="{{ route('utilities.batchprint') }}"><i
                            class="fa fa-print"></i> {{ trans('fi.batchprint') }}</a>
                <a class="dropdown-item" href="{{ route('utilities.manage_trash') }}"><i
                            class="fa fa-trash"></i> {{ trans('fi.manage_trash') }}</a>


            </div>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.system') }}">
                <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('addons.index') }}">{{ trans('fi.addons') }}</a>
                <a class="dropdown-item" href="{{ route('currencies.index') }}">{{ trans('fi.currencies') }}</a>
                <a class="dropdown-item" href="{{ route('customFields.index') }}">{{ trans('fi.custom_fields') }}</a>
                <a class="dropdown-item"
                   href="{{ route('companyProfiles.index') }}">{{ trans('fi.company_profiles') }}</a>
                <a class="dropdown-item" href="{{ route('export.index') }}">{{ trans('fi.export_data') }}</a>
                <a class="dropdown-item" href="{{ route('groups.index') }}">{{ trans('fi.groups') }}</a>
                <a class="dropdown-item" href="{{ route('import.index') }}">{{ trans('fi.import_data') }}</a>
                <a class="dropdown-item"
                   href="{{ route('paymentMethods.index') }}">{{ trans('fi.payment_methods') }}</a>
                <a class="dropdown-item" href="{{ route('taxRates.index') }}">{{ trans('fi.tax_rates') }}</a>
                <a class="dropdown-item" href="{{ route('users.index') }}">{{ trans('fi.user_accounts') }}</a>
                <a class="dropdown-item" href="{{ route('settings.index') }}">{{ trans('fi.system_settings') }}</a>
                @foreach (config('fi.menus.system') as $menu)
                    @if (view()->exists($menu))
                        @include($menu)
                    @endif
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            {{--<a class="nav-link" href="/documentation" title="{{ trans('fi.documentation') }}"--}}
            <a class="nav-link" href="{{ url('documentation', ['Requirements']) }}"
               title="{{ trans('fi.documentation') }}"
               aria-haspopup="true" aria-expanded="false" target="_blank">
                <i class="fa fa-question-circle"></i>
            </a>
        </li>

        <li class="nav-item">

            <a class="nav-link" href="{{ route('session.logout') }}" title="{{ trans('fi.sign_out') }}"
               aria-haspopup="true" aria-expanded="false"><i
                        class="fa fa-power-off"></i></a>
        </li>

    </div>

</nav>

{{--</header>--}}