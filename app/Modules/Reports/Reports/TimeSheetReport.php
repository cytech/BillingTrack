<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Reports;

use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Support\DateFormatter;
use DB;

class TimeSheetReport {
	public function getResults( $fromDate, $toDate, $companyProfileId = null ) {
		$results = [
			'from_date' => '',
			'to_date'   => '',
			'total_records',
			'total_hours'   => '',
			'records'   => [],
		];

		$invoices = Invoice::select( 'invoice_items.invoice_id AS InvoiceID', 'invoices.number AS InvoiceNumber',
			'clients.name AS CustomerName', 'invoice_items.name AS ItemName',
			'invoice_items.quantity AS ItemQty', 'employees.number AS EmpNumber',
			'invoices.invoice_date AS DateFinished', DB::raw( 'CONCAT(employees.last_name,", ",employees.first_name) AS FullName' ) )
		                   ->join( 'invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id' )
		                   ->join( 'clients', 'clients.id', '=', 'invoices.client_id' )
		                   ->join( 'employees', 'employees.id', '=', 'invoice_items.resource_id' )
		                   ->whereBetween( 'invoice_date', [ $fromDate, $toDate ] )
		                   ->where( 'invoice_items.resource_table', 'employees' )
		                   ->orderBy( 'FullName', 'ASC' )
		                   ->orderBy( 'DateFinished', 'ASC' );

		if ( $companyProfileId ) {
			$companyProfile = CompanyProfile::where( 'id', $companyProfileId )->first();
			$results['companyProfile_company'] = $companyProfile->company;

			$invoices->where( 'company_profile_id', $companyProfileId );
		} else {
			$results['companyProfile_company'] = 'All Billing';
		}

		$invoices = $invoices->get();

		$results['from_date'] = DateFormatter::format( $fromDate );
		$results['to_date']   = DateFormatter::format( $toDate );
		$results['total_records'] = count($invoices);

		if ( ! count( $invoices ) ) {

			return $results;
		}

		$totalhours = $invoices->sum( 'ItemQty' );

		foreach ( $invoices as $invoice ) {
			$results['records'][] = [
				'number'                 => $invoice->InvoiceNumber,
				'client_name'            => $invoice->CustomerName,
				'formatted_invoice_date' => $invoice->DateFinished,
				'item_name'              => $invoice->ItemName,
				'item_qty'               => $invoice->ItemQty,
				'full_name'              => $invoice->FullName,
				'employee_number'        => $invoice->EmpNumber,
			];

		}

		$results['total_hours'] = $totalhours;

		return $results;
	}

	public function getResultsIIF( $fromDate, $toDate, $companyProfileId = null ) {
		$results = [
			'from_date' => '',
			'to_date'   => '',
			'records'   => [],
		];

		$invoices = Invoice::select( DB::raw( '"TIMEACT" AS TIMEACT' ),
			DB::raw( 'DATE_FORMAT(invoices.invoice_date,"%m/%d/%y") AS DATE' ),
			DB::raw( 'NULL AS JOB' ),
			DB::raw( 'CONCAT_WS(", ",employees.last_name, employees.first_name) AS EMP' ),
			DB::raw( 'NULL AS ITEM' ),
			DB::raw( '"Hourly Wage" AS PITEM' ),
			DB::raw( 'ROUND(invoice_items.quantity,2) AS DURATION' ),
			DB::raw( 'NULL AS PROJ' ),
			DB::raw( 'NULL AS NOTE' ),
			DB::raw( '"0" AS BILLINGSTATUS' ) )
		                   ->join( 'invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id' )
		                   ->join( 'clients', 'clients.id', '=', 'invoices.client_id' )
		                   ->join( 'employees', 'employees.id', '=', 'invoice_items.resource_id' )
		                   ->whereBetween( 'invoice_date', [ $fromDate, $toDate ] )
		                   ->where( 'invoice_items.resource_table', 'employees' )
		                   ->orderBy( 'EMP', 'ASC' )
		                   ->orderBy( 'DATE', 'ASC' );


		if ( $companyProfileId ) {
			$companyProfile = CompanyProfile::where( 'id', $companyProfileId )->first();
			$results['companyProfile_company'] = $companyProfile->company;

			$invoices->where( 'company_profile_id', $companyProfileId );
		} else {
			$results['companyProfile_company'] = 'All Billing';
			$results['TSCompanyCreate'] = config('bt.tsCompanyCreate');
			$results['TSCompanyName'] = config('bt.tsCompanyName');
		}

		$invoices = $invoices->get();

		$results['from_date'] = DateFormatter::format( $fromDate );
		$results['to_date']   = DateFormatter::format( $toDate );

		if ( ! count( $invoices ) ) {
			return $results;
		}

		foreach ( $invoices as $invoice ) {
			$results['records'][] = [
				'TIMEACT'                 => $invoice->TIMEACT,
				'DATE'            => $invoice->DATE,
				'JOB' => $invoice->JOB,
				'EMP'              => $invoice->EMP,
				'ITEM'               => $invoice->ITEM,
				'PITEM'              => $invoice->PITEM,
				'DURATION'        => $invoice->DURATION,
				'PROJ'        => $invoice->PROJ,
				'NOTE'        => $invoice->NOTE,
				'BILLINGSTATUS'        => $invoice->BILLINGSTATUS,
			];

		}

		return $results;
	}
}
