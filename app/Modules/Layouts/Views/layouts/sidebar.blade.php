{{--<aside class="main-sidebar sidebar-dark-primary elevation-2">--}}

<aside class="main-sidebar sidebar-dark-dark elevation-2">
    <a href="/" class="brand-link bg-{{ str_replace('skin-', '', $skinClass) }} border-bottom">
        <img src="/img/fi_logo.png" alt="FusionInvoiceFOSS Logo" class="brand-image img-circle elevation-3 img-sm"
        style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'FusionInvoiceFOSS') }}</span>
    </a>

    <div class="sidebar bg-light">

        @if (config('fi.displayProfileImage'))
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
                           placeholder="{{ trans('fi.search') }}..."/>
                    <span class="input-group-append">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
        @endif
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('fi.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index', ['status' => 'active']) }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ trans('fi.clients') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('quotes.index', ['status' => config('fi.quoteStatusFilter')]) }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>{{ trans('fi.quotes') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('workorders.index', ['status' => config('fi.workorderStatusFilter')]) }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>{{ trans('fi.workorders') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('invoices.index', ['status' => config('fi.invoiceStatusFilter')]) }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>{{ trans('fi.invoices') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recurringInvoices.index') }}">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>{{ trans('fi.recurring_invoices') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>{{ trans('fi.payments') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>{{ trans('fi.expenses') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('timeTracking.projects.index', ['status' => 1]) }}">
                        <i class="nav-icon far fa-clock"></i>
                        <p>{{ trans('fi.time_tracking') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>{{ trans('fi.scheduler') }}</p>
                        <i class="nav-icon fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="nav nav-treeview nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.index') }}"><i
                                        class="nav-icon fas fa-tachometer-alt ml-3"></i>
                                <p> {{ trans('fi.dashboard') }}</p></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.fullcalendar') }}"><i
                                        class="nav-icon fa fa-th ml-3"></i> {{ trans('fi.calendar') }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.create') }}"><i
                                        class="nav-icon fa fa-plus ml-3"></i> {{ trans('fi.create_event') }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.tableevent') }}"><i
                                        class="nav-icon fa fa-table ml-3"></i> {{ trans('fi.table_event') }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.tablerecurringevent') }}"><i
                                        class="nav-icon fa fa-sync-alt ml-3"></i> {{ trans('fi.recurring_event') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="nav-icon fa fa-cogs fa-fw ml-3"></i>
                                <p>{{ trans('fi.utilities') }}</p><i
                                        class="nav-icon fa fa-angle-left float-right"></i></a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('scheduler.categories.index') }}"><i
                                                class="nav-icon fas fa-thumbtack fa-fw ml-4"></i>{{ trans('fi.categories') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('scheduler.checkschedule') }}"><i
                                                class="nav-icon fas fa-check-double fa-fw ml-4"></i>{{ trans('fi.orphan_check') }}
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('scheduler.about') }}"><i
                                                class="nav-icon fa fa-question-circle fa-fw ml-4"></i> {{ trans('fi.about') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>{{ trans('fi.reports') }}</p>
                        <i class="nav-icon fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.clientStatement') }}"><i
                                        class="ml-4"></i> {{ trans('fi.client_statement') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.expenseList') }}"><i
                                        class="ml-4"></i> {{ trans('fi.expense_list') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.itemSales') }}"><i
                                        class="ml-4"></i> {{ trans('fi.item_sales') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.paymentsCollected') }}"><i
                                        class="ml-4"></i> {{ trans('fi.payments_collected') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.profitLoss') }}"><i
                                        class="ml-4"></i> {{ trans('fi.profit_and_loss') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.revenueByClient') }}"><i
                                        class="ml-4"></i> {{ trans('fi.revenue_by_client') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.taxSummary') }}"><i
                                        class="ml-4"></i> {{ trans('fi.tax_summary') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('timeTracking.reports.timesheet') }}"><i
                                        class="ml-4"></i> {{ trans('fi.time_tracking') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('timesheets.report') }}"><i
                                        class="ml-4"></i>{{ trans('fi.timesheet') }}</a></li>

                        @foreach (config('fi.menus.reports') as $report)
                            @if (view()->exists($report))
                                @include($report)
                            @endif
                        @endforeach
                    </ul>
                </li>

                @foreach (config('fi.menus.navigation') as $menu)
                    @if (view()->exists($menu))
                        @include($menu)
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

</aside>