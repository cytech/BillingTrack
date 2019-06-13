<?php

namespace BT\Widgets\Dashboard\RecentPayments\Composers;

use BT\Modules\Payments\Models\Payment;

class RecentPaymentsWidgetComposer
{
    public function compose($view)
    {
        $recentPayments = Payment::with('client')
            ->orderBy('paid_at', 'DESC')
            ->take(10)
            ->get();

        $view->with('recentPayments', $recentPayments);
    }
}
