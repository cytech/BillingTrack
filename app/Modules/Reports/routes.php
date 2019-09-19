<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::middleware(['web', 'auth.admin'])->namespace('BT\Modules\Reports\Controllers')
    ->prefix('report')->name('reports.')->group(function () {
        Route::name('clientStatement')->get('client_statement', 'ClientStatementReportController@index');
        Route::name('clientStatement.validate')->post('client_statement/validate', 'ClientStatementReportController@validateOptions');
        Route::name('clientStatement.html')->get('client_statement/html', 'ClientStatementReportController@html');
        Route::name('clientStatement.pdf')->get('client_statement/pdf', 'ClientStatementReportController@pdf');

        Route::name('expenseList')->get('expense_list', 'ExpenseListReportController@index');
        Route::name('expenseList.validate')->post('expense_list/validate', 'ExpenseListReportController@validateOptions');
        Route::name('expenseList.html')->get('expense_list/html', 'ExpenseListReportController@html');
        Route::name('expenseList.pdf')->get('expense_list/pdf', 'ExpenseListReportController@pdf');

        Route::name('itemSales')->get('item_sales', 'ItemSalesReportController@index');
        Route::name('itemSales.validate')->post('item_sales/validate', 'ItemSalesReportController@validateOptions');
        Route::name('itemSales.html')->get('item_sales/html', 'ItemSalesReportController@html');
        Route::name('itemSales.pdf')->get('item_sales/pdf', 'ItemSalesReportController@pdf');

        Route::name('paymentsCollected')->get('payments_collected', 'PaymentsCollectedReportController@index');
        Route::name('paymentsCollected.validate')->post('payments_collected/validate', 'PaymentsCollectedReportController@validateOptions');
        Route::name('paymentsCollected.html')->get('payments_collected/html', 'PaymentsCollectedReportController@html');
        Route::name('paymentsCollected.pdf')->get('payments_collected/pdf', 'PaymentsCollectedReportController@pdf');

        Route::name('profitLoss')->get('profit_loss', 'ProfitLossReportController@index');
        Route::name('profitLoss.validate')->post('profit_loss/validate', 'ProfitLossReportController@validateOptions');
        Route::name('profitLoss.html')->get('profit_loss/html', 'ProfitLossReportController@html');
        Route::name('profitLoss.pdf')->get('profit_loss/pdf', 'ProfitLossReportController@pdf');

        Route::name('revenueByClient')->get('revenue_by_client', 'RevenueByClientReportController@index');
        Route::name('revenueByClient.validate')->post('revenue_by_client/validate', 'RevenueByClientReportController@validateOptions');
        Route::name('revenueByClient.html')->get('revenue_by_client/html', 'RevenueByClientReportController@html');
        Route::name('revenueByClient.pdf')->get('revenue_by_client/pdf', 'RevenueByClientReportController@pdf');

        Route::name('taxSummary')->get('tax_summary', 'TaxSummaryReportController@index');
        Route::name('taxSummary.validate')->post('tax_summary/validate', 'TaxSummaryReportController@validateOptions');
        Route::name('taxSummary.html')->get('tax_summary/html', 'TaxSummaryReportController@html');
        Route::name('taxSummary.pdf')->get('tax_summary/pdf', 'TaxSummaryReportController@pdf');

        Route::name('timeTracking')->get('timetracking', 'TimeTrackingReportController@index');
        Route::name('timeTracking.validate')->post('timetracking/validate', 'TimeTrackingReportController@ajaxValidate');
        Route::name('timeTracking.html')->get('timetracking/html', 'TimeTrackingReportController@html');
        Route::name('timeTracking.pdf')->get('timetracking/pdf', 'TimeTrackingReportController@pdf');

        Route::name('timesheet')->get('timesheet_report', 'TimeSheetReportController@report');
        Route::name('timesheet.validate')->post('timesheet_report/validate', 'TimeSheetReportController@ajaxValidate');
        Route::name('timesheet.html')->get('timesheet_report/html', 'TimeSheetReportController@html');
        Route::name('timesheet.pdf')->get('timesheet_report/pdf', 'TimeSheetReportController@pdf');
        Route::name('timesheet.iif')->get('timesheet_report/iif', 'TimeSheetReportController@iif');
    });
