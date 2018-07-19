
<li class="treeview">
    <a href="#">
        <i class="fa fa-file-text-o"></i>
        <span>{{ trans('Workorders::texts.workorders') }}</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('workorders.dashboard') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('Workorders::texts.dashboard') }}
            </a>
        </li>
       {{-- <li>
            <a href="javascript:void(0)" class="create-workorder"><i class="fa fa-plus-square-o"></i><span> {{ trans('Workorders::texts.create_workorder') }}</span></a>
        </li>--}}
        <li><a href="{{ route('workorders.index', ['status' => config('workorder_settings.statusFilter')]) }}">
                <i class="fa fa-file-text-o"></i> <span>{{ trans('Workorders::texts.workorder_table') }}</span>
            </a>
        </li>
        <li><a href="{{ route('employees.index') }}"><i
                        class="fa fa-users"></i> {{ trans('Workorders::texts.employees') }}
            </a>
        </li>
        <li><a href="{{ route('resources.index') }}"><i
                        class="fa fa-shopping-cart"></i> {{ trans('Workorders::texts.resources') }}
            </a>
        </li>

        <li class="treeview">
            <a href="#"><i class="fa fa-clock-o fa-fw"></i>
                <span>{{ trans('Workorders::texts.timesheet') }}</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ route('timesheets.index') }}"><i
                                class="fa fa-table"></i> {{ trans('Workorders::texts.timesheettable') }}
                    </a>
                </li>
                <li><a href="{{ route('timesheets.report') }}"><i
                                class="fa fa-file-text-o"></i> {{ trans('Workorders::texts.timesheetreport') }}
                    </a>
                </li>
                <li><a href="{{ route('timesheets.about') }}"><i
                                class="fa fa-question-circle"></i> {{ trans('Workorders::texts.about') }}
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
                                    class="fa fa-print"></i> {{ trans('Workorders::texts.batchprint') }}
                        </a>
                    </li>
                @endif

                <li><a href="{{ route('workorders.settings') }}"><i
                                class="fa fa-wrench"></i> {{ trans('Workorders::texts.workorder_settings') }}
                    </a>
                </li>
                    <li><a href="{{ route('workorders.trash') }}"><i
                                    class="fa fa-trash"></i> {{ trans('Workorders::texts.trash') }}
                        </a>
                    </li>
                <li><a href="{{ route('workorders.about') }}"><i
                                class="fa fa-question-circle"></i> {{ trans('Workorders::texts.about') }}
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</li>
