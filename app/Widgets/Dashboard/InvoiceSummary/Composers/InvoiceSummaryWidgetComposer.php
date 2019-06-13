<?php

namespace BT\Widgets\Dashboard\InvoiceSummary\Composers;

use BT\Modules\Invoices\Models\InvoiceAmount;
use BT\Modules\Payments\Models\Payment;
use BT\Support\CurrencyFormatter;
use Illuminate\Support\Facades\DB;

class InvoiceSummaryWidgetComposer
{
    public function compose($view)
    {
        $view->with('invoicesTotalDraft', $this->getInvoicesTotalDraft())
            ->with('invoicesTotalSent', $this->getInvoicesTotalSent())
            ->with('invoicesTotalPaid', $this->getInvoicesTotalPaid())
            ->with('invoicesTotalOverdue', $this->getInvoicesTotalOverdue())
            ->with('invoiceDashboardTotalOptions', periods());
    }

    private function getInvoicesTotalDraft()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->draft();
                switch (config('bt.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('bt.widgetInvoiceSummaryDashboardTotalsFromDate'), config('bt.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }

    private function getInvoicesTotalSent()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->sent();
                switch (config('bt.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('bt.widgetInvoiceSummaryDashboardTotalsFromDate'), config('bt.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }

    private function getInvoicesTotalPaid()
    {
        $payments = Payment::join('invoices', 'invoices.id', '=', 'payments.invoice_id');

        switch (config('bt.widgetInvoiceSummaryDashboardTotals'))
        {
            case 'year_to_date':
                $payments->yearToDate();
                break;
            case 'this_quarter':
                $payments->thisQuarter();
                break;
            case 'custom_date_range':
                $payments->dateRange(config('bt.widgetInvoiceSummaryDashboardTotalsFromDate'), config('bt.widgetInvoiceSummaryDashboardTotalsToDate'));
                break;
        }

        return CurrencyFormatter::format($payments->sum(DB::raw('amount / exchange_rate')));
    }

    private function getInvoicesTotalOverdue()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->overdue();
                switch (config('bt.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('bt.widgetInvoiceSummaryDashboardTotalsFromDate'), config('bt.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }
}
