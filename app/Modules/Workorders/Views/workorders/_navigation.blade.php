
<li class="treeview">
    <a href="#">
        <i class="fa fa-file-text-o"></i>
        <span>{{ trans('fi.workorders') }}</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('workorders.dashboard') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('fi.dashboard') }}
            </a>
        </li>
       {{-- <li>
            <a href="javascript:void(0)" class="create-workorder"><i class="fa fa-plus-square-o"></i><span> {{ trans('fi.create_workorder') }}</span></a>
        </li>--}}
        <li><a href="{{ route('workorders.index', ['status' => config('workorder_settings.statusFilter')]) }}">
                <i class="fa fa-file-text-o"></i> <span>{{ trans('fi.workorder_table') }}</span>
            </a>
        </li>
        <li><a href="{{ route('employees.index') }}"><i
                        class="fa fa-users"></i> {{ trans('fi.employees') }}
            </a>
        </li>
        <li><a href="{{ route('resources.index') }}"><i
                        class="fa fa-shopping-cart"></i> {{ trans('fi.resources') }}
            </a>
        </li>

        <li class="treeview">
            <a href="#"><i class="fa fa-clock-o fa-fw"></i>
                <span>{{ trans('fi.timesheet') }}</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ route('timesheets.index') }}"><i
                                class="fa fa-table"></i> {{ trans('fi.timesheettable') }}
                    </a>
                </li>
                <li><a href="{{ route('timesheets.report') }}"><i
                                class="fa fa-file-text-o"></i> {{ trans('fi.timesheetreport') }}
                    </a>
                </li>
                <li><a href="{{ route('timesheets.about') }}"><i
                                class="fa fa-question-circle"></i> {{ trans('fi.about') }}
                    </a>
                </li>
            </ul>
        </li>


        <li class="treeview">
            <a href="#"><i class="fa fa-cogs fa-fw"></i>
                <span>Utilities</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                @if(config('fi.pdfDriver') == 'wkhtmltopdf')
                    <li><a href="{{ route('workorders.batchprint') }}"><i
                                    class="fa fa-print"></i> {{ trans('fi.batchprint') }}
                        </a>
                    </li>
                @endif

                <li><a href="{{ route('workorders.settings') }}"><i
                                class="fa fa-wrench"></i> {{ trans('fi.workorder_settings') }}
                    </a>
                </li>
                    <li><a href="{{ route('workorders.trash') }}"><i
                                    class="fa fa-trash"></i> {{ trans('fi.trash') }}
                        </a>
                    </li>
                <li><a href="{{ route('workorders.about') }}"><i
                                class="fa fa-question-circle"></i> {{ trans('fi.about') }}
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</li>
