<header class="main-header">

    <a href="{{ route('dashboard.index')}}" class="logo">
        <span class="logo-lg">{{ config('fi.headerTitleText') }}</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        {{--<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">--}}
            {{--<span class="sr-only">Toggle navigation</span>--}}
            {{--<span class="icon-bar"></span>--}}
            {{--<span class="icon-bar"></span>--}}
            {{--<span class="icon-bar"></span>--}}
        {{--</a>--}}
        <ul class="nav navbar-nav">
            <li><a href="#" class="nav-link" data-toggle="push-menu" ><i class="fa fa-bars"></i></a></li>
        </ul>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li>
                    <a href="/documentation" title="{{ trans('fi.documentation') }}" target="_blank">
                        <i class="fa fa-question-circle"></i>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.utilities') }}">
                        <i class="fa fa-toolbox"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('employees.index') }}"><i class="fa fa-users"></i>{{ trans('fi.employees') }}</a></li>
                        <li><a href="{{ route('products.index') }}"><i class="fa fa-shopping-cart"></i>{{ trans('fi.products') }}</a></li>
                        <li><a href="{{ route('itemLookups.index') }}"><i class="fa fa-eye"></i>{{ trans('fi.item_lookups') }}</a></li>
                        <li><a href="{{ route('mailLog.index') }}"><i class="fa fa-envelope-square"></i>{{ trans('fi.mail_log') }}</a></li>
                        <li><a href="{{ route('utilities.batchprint') }}"><i class="fa fa-print"></i>{{ trans('fi.batchprint') }}</a></li>
                        <li><a href="{{ route('utilities.manage_trash') }}"><i class="fa fa-trash"></i>{{ trans('fi.manage_trash') }}</a></li>

                        <li class="dropdown-submenu pull-left">
                            <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.about') }}">
                                <i class="fa fa-question-circle"></i>{{ trans('fi.about') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="#"><i class="fa fa-file"></i>FusionInvoiceFOSS</a></li>
                                <li><a tabindex="-1" href="{{ route('workorders.about') }}"><i class="fa fa-file"></i>{{ trans('fi.workorders') }}</a></li>
                                <li><a tabindex="-1" href="{{ route('scheduler.about') }}"><i class="fa fa-file"></i>{{ trans('fi.scheduler') }}</a></li>
                                <li><a tabindex="-1" href="{{ route('timesheets.about') }}"><i class="fa fa-clock"></i>{{ trans('fi.timesheet') }}</a></li>
                            </ul>
                        </li>


                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="{{ trans('fi.system') }}">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('addons.index') }}">{{ trans('fi.addons') }}</a></li>
                        <li><a href="{{ route('currencies.index') }}">{{ trans('fi.currencies') }}</a></li>
                        <li><a href="{{ route('customFields.index') }}">{{ trans('fi.custom_fields') }}</a></li>
                        <li><a href="{{ route('companyProfiles.index') }}">{{ trans('fi.company_profiles') }}</a></li>
                        <li><a href="{{ route('export.index') }}">{{ trans('fi.export_data') }}</a></li>
                        <li><a href="{{ route('groups.index') }}">{{ trans('fi.groups') }}</a></li>
                        <li><a href="{{ route('import.index') }}">{{ trans('fi.import_data') }}</a></li>
                        <li><a href="{{ route('paymentMethods.index') }}">{{ trans('fi.payment_methods') }}</a></li>
                        <li><a href="{{ route('taxRates.index') }}">{{ trans('fi.tax_rates') }}</a></li>
                        <li><a href="{{ route('users.index') }}">{{ trans('fi.user_accounts') }}</a></li>
                        <li><a href="{{ route('settings.index') }}">{{ trans('fi.system_settings') }}</a></li>
                        @foreach (config('fi.menus.system') as $menu)
                            @if (view()->exists($menu))
                                @include($menu)
                            @endif
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="{{ route('session.logout') }}" title="{{ trans('fi.sign_out') }}"><i class="fa fa-power-off"></i></a>
                </li>

            </ul>
        </div>
    </nav>
</header>