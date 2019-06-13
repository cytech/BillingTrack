<?php

namespace BT\Widgets\Dashboard\WorkorderSummary\Composers;

class WorkorderSummarySettingComposer
{
    public function compose($view)
    {
        $view->with('dashboardTotalOptions', periods());
    }
}
