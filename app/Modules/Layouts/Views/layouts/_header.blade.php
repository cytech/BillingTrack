{{--<header class="main-header">--}}

{{--<a href="{{ route('dashboard.index')}}" class="logo">--}}
{{--<span class="logo-lg">{{ config('fi.headerTitleText') }}</span>--}}
{{--</a>--}}

{{--<nav class="main-header navbar navbar-expand navbar-light border-bottom">--}}
<nav class="main-header navbar navbar-expand navbar-dark bg-{{ str_replace('skin-', '', $skinClass) }} border-bottom">
    {{--<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">--}}
    {{--<span class="sr-only">Toggle navigation</span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--</a>--}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"
                                                                   ></i></a>
        </li>
    </ul>
        {{--<div class="navbar-custom-menu">--}}
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
                   <a class="dropdown-item" href="{{ route('companyProfiles.index') }}">{{ trans('fi.company_profiles') }}</a>
                   <a class="dropdown-item" href="{{ route('export.index') }}">{{ trans('fi.export_data') }}</a>
                   <a class="dropdown-item" href="{{ route('groups.index') }}">{{ trans('fi.groups') }}</a>
                   <a class="dropdown-item" href="{{ route('import.index') }}">{{ trans('fi.import_data') }}</a>
                   <a class="dropdown-item" href="{{ route('paymentMethods.index') }}">{{ trans('fi.payment_methods') }}</a>
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
                <a class="nav-link" href="/documentation" title="{{ trans('fi.documentation') }}"
                   aria-haspopup="true" aria-expanded="false" target="_blank">
                    <i class="fa fa-file"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.about') }}">
                    <i class="fa fa-question-circle"></i>
                </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{--<a class="dropdown-item" tabindex="-1" href="#"><i class="fa fa-file"></i>FusionInvoiceFOSS</a>--}}
                            <a class="dropdown-item" tabindex="-1" href="{{ route('workorders.about') }}"><i
                                        class="fa fa-file"></i> {{ trans('fi.workorders') }}</a>
                            <a class="dropdown-item" tabindex="-1" href="{{ route('scheduler.about') }}"><i
                                        class="fa fa-file"></i> {{ trans('fi.scheduler') }}</a>
                            <a class="dropdown-item" tabindex="-1" href="{{ route('timesheets.about') }}"><i
                                        class="fa fa-clock"></i> {{ trans('fi.timesheet') }}</a>


                        </div>


            </li>

            <li class="nav-item">

            <a class="nav-link" href="{{ route('session.logout') }}" title="{{ trans('fi.sign_out') }}" aria-haspopup="true" aria-expanded="false"><i
                            class="fa fa-power-off"></i></a>
            </li>

        </div>

</nav>

{{--</header>--}}