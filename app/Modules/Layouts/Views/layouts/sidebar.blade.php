<aside class="main-sidebar sidebar-{{ $headClass }} elevation-2">
    <a href="/" class="brand-link bg-{{ $headBackground }} border-bottom">
        <img src="/img/billingtrack_logo.svg" alt="BillingTrack Logo" class="brand-image img-circle elevation-3 img-sm"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('bt.headerTitleText', config('app.name','BillingTrack')) }}</span>
    </a>

    <div class="sidebar bg-{{ $sidebarBackground }}">

        @if (config('bt.displayProfileImage'))
            <div class="user-panel">
                <div class="float-left image">
                    <img src="{{ $profileImageUrl }}" alt="User Image"/>
                </div>
                <div class="float-left info">
                    <p>{{ $userName }}</p>
                </div>
            </div>
        @endif

        @if (isset($displaySearch) and $displaySearch == true)
            <form action="{{ request()->fullUrl() }}" method="get" class="sidebar-form">
                <input type="hidden" name="status" value="{{ request('status') }}"/>
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="@lang('bt.search')..."/>
                    <span class="input-group-append">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
        @endif
        <nav class="mt-2">

            <ul class="nav nav-pills-{{ $sidebarClass }} nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('bt.dashboard')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index', ['status' => 'active']) }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>@lang('bt.clients')</p>
                    </a>
                </li>
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('quote'))
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('quotes.index', ['status' => config('bt.quoteStatusFilter')]) }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>@lang('bt.quotes')</p>
                    </a>
                </li>
                @endif
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('workorder'))
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('workorders.index', ['status' => config('bt.workorderStatusFilter')]) }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>@lang('bt.workorders')</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('invoices.index', ['status' => config('bt.invoiceStatusFilter')]) }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>@lang('bt.invoices')</p>
                    </a>
                </li>
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('recurring_invoice'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recurringInvoices.index') }}">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>@lang('bt.recurring_invoices')</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>@lang('bt.payments')</p>
                    </a>
                </li>
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('expense'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>@lang('bt.expenses')</p>
                    </a>
                </li>
                @endif
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('time_tracking'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('timeTracking.projects.index', ['status' => 1]) }}">
                        <i class="nav-icon far fa-clock"></i>
                        <p>@lang('bt.time_tracking')</p>
                    </a>
                </li>
                @endif
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('purchaseorder'))
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('purchaseorders.index', ['status' => config('bt.invoiceStatusFilter')]) }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>@lang('bt.purchaseorders')</p>
                    </a>
                </li>
                @endif
                @if(\BT\Modules\Settings\Models\Setting::isModuleEnabled('scheduler'))
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>@lang('bt.scheduler')</p>
                        <i class="nav-icon fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="nav nav-treeview nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.index') }}"><i
                                        class="nav-icon fas fa-tachometer-alt ml-3"></i>
                                <p> @lang('bt.dashboard')</p></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.fullcalendar') }}"><i
                                        class="nav-icon fa fa-th ml-3"></i> @lang('bt.calendar')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.showschedule') }}"><i
                                        class="nav-icon far fa-clock ml-3"></i> @lang('bt.schedule')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.create') }}"><i
                                        class="nav-icon fa fa-plus ml-3"></i> @lang('bt.create_event')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.tableevent') }}"><i
                                        class="nav-icon fa fa-table ml-3"></i> @lang('bt.table_event')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.tablerecurringevent') }}"><i
                                        class="nav-icon fa fa-sync-alt ml-3"></i> @lang('bt.recurring_event')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="nav-icon fa fa-cogs fa-fw ml-3"></i>
                                <p>@lang('bt.utilities')</p><i
                                        class="nav-icon fa fa-angle-left float-right"></i></a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('scheduler.categories.index') }}"><i
                                                class="nav-icon fas fa-thumbtack fa-fw ml-4"></i>@lang('bt.categories')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('scheduler.checkschedule') }}"><i
                                                class="nav-icon fas fa-check-double fa-fw ml-4"></i>@lang('bt.orphan_check')
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>@lang('bt.reports')</p>
                        <i class="nav-icon fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.clientStatement') }}"><i
                                        class="ml-4"></i> @lang('bt.client_statement')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.expenseList') }}"><i
                                        class="ml-4"></i> @lang('bt.expense_list')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.itemSales') }}"><i
                                        class="ml-4"></i> @lang('bt.item_sales')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.paymentsCollected') }}"><i
                                        class="ml-4"></i> @lang('bt.payments_collected')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.profitLoss') }}"><i
                                        class="ml-4"></i> @lang('bt.profit_and_loss')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.revenueByClient') }}"><i
                                        class="ml-4"></i> @lang('bt.revenue_by_client')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.taxSummary') }}"><i
                                        class="ml-4"></i> @lang('bt.tax_summary')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.timeTracking') }}"><i
                                        class="ml-4"></i> @lang('bt.time_tracking')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.timesheet') }}"><i
                                        class="ml-4"></i>@lang('bt.timesheet')</a></li>

                        @foreach (config('bt.menus.reports') as $report)
                            @if (view()->exists($report))
                                @include($report)
                            @endif
                        @endforeach
                    </ul>
                </li>

                @foreach (config('bt.menus.navigation') as $menu)
                    @if (view()->exists($menu))
                        @include($menu)
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

</aside>
