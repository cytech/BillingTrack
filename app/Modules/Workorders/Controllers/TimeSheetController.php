<?php

/**
 * This file is part of Workorders Addon for FusionInvoice.
 * (c) Cytech <cytech@cytech-eng.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Addons\Workorders\Controllers;

use FI\Http\Controllers\Controller;
use Addons\Workorders\Support\TimeSheetReport;
use Addons\Workorders\Requests\TimeSheetReportRequest;
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Support\PDF\PDFFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use FI\Modules\Invoices\Models\Invoice;
use DB;

class TimeSheetController extends Controller
{
    private $timeSheetReport;

    public function __construct(
	    TimeSheetReport $timeSheetReport
    )
    {
        $this->timeSheetReport = $timeSheetReport;
    }

	//timesheet generation from employee workorders that have been invoiced
	public function index( Request $request )
	{
		if ( $request->isMethod( 'post' ) ) {
			$start = $request->start_date;
			$end   = $request->end_date;

			$invoices = Invoice::select( 'invoice_items.invoice_id AS InvoiceID', 'invoices.number AS InvoiceNumber',
				'clients.name AS CustomerName', 'invoice_items.name AS ItemName',
				'invoice_items.quantity AS ItemQty', 'workorder_employees.number AS EmpNumber',
				'invoices.invoice_date AS DateFinished', DB::raw( 'CONCAT(workorder_employees.last_name,", ",workorder_employees.first_name) AS FullName' ) )
			                   ->join( 'invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id' )
			                   ->join( 'clients', 'clients.id', '=', 'invoices.client_id' )
			                   ->join( 'workorder_employees', 'workorder_employees.id', '=', 'invoice_items.resource_id' )
			                   ->whereBetween( 'invoice_date', [ $start, $end ] )
			                   ->where( 'invoice_items.resource_table', 'employees' )
			                   ->orderBy( 'FullName', 'ASC' )
			                   ->orderBy( 'DateFinished', 'ASC' )
			                   ->get();

			if ( ! count( $invoices ) ) {
				return redirect()->back()
				                 ->with( 'alert', trans('Workorders::texts.timesheet_nodata_alert') );
			}

			$totalhours = $invoices->sum('ItemQty');

			return view('timesheets.index')
				->with('invoices', $invoices)
				->with('totalhours',$totalhours);

		} else {
			$week_ini = new Carbon( "Monday last week" );
			$week_end = new Carbon( "last Sunday" );

			return view( 'workorders.getdates', [
				'start_date' => $week_ini,
				'end_date'   => $week_end,
				'title'      => 'TimeSheet'
			] );
		}
	}

	public function report()
    {
	    $week_ini = new Carbon( "Monday last week" );
	    $week_end = new Carbon( "last Sunday" );

        return view('timesheets.reports', [
	        'fromDate' => $week_ini,
	        'toDate'   => $week_end,
	        'title'      => 'TimeSheet'
        ])
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + CompanyProfile::getList());
    }

	public function about()
	{
		return view('timesheets.about');
	}


    public function ajaxValidate(TimeSheetReportRequest $request)
    {

        return response()->json(['success' => true]);
    }

    public function html()
    {
        $results = $this->timeSheetReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        return view('timesheets._pdfhtml')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->timeSheetReport->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        $html = view('timesheets._pdfhtml')
            ->with('results', $results)->render();

        $pdf->download($html, trans('Workorders::texts.timesheet') .Date('Y-m-d'). '.pdf');
    }

	public function iif()
	{
		$results = $this->timeSheetReport->getResultsIIF(
			request('from_date'),
			request('to_date'),
			request('company_profile_id'));

		if ( ! count( $results['records'] ) ) {
			return redirect()->back()
			                 ->with( 'alert', trans('Workorders::texts.timesheet_nodata_alert') );
		}

		// output as an attachment
		$this->query_to_csv($results,"TimeSheet2QB-".Date('Ymd').".iif", true);
	}

	public function query_to_csv( $results, $filename, $attachment = false, $headers = false ) {

		if ( $attachment ) {
			// send response headers to the browser
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: attachment;filename=' . $filename );
			$fp = fopen( 'php://output', 'w' );
		} else {
			$fp = fopen( $filename, 'w' );
		}

		//NOTE !TIMERHEADER VER & REL REQUIRE SPACE BEFORE NUMBER,all tab delimited
		$headeroutput = "!TIMERHDR	VER	REL	COMPANYNAME	IMPORTEDBEFORE	FROMTIMER	COMPANYCREATETIME
TIMERHDR	 8	 0	".$results['TSCompanyName']."	N	Y	".$results['TSCompanyCreate']."
!TIMEACT	DATE	JOB	EMP	ITEM	PITEM	DURATION	PROJ	NOTE	BILLINGSTATUS\n";

		fwrite( $fp, $headeroutput );
		//TIMEACT	01/06/14		Schmoe, Joe		Hourly Wage	1.5			N	0
		foreach ($results['records'] as $row){
			$this->fputcsv2( $fp, $row, "\t" );
		}

		fclose( $fp );
	}

	public function fputcsv2( $fh, array $fields, $delimiter = ',', $enclosure = '', $mysql_null = false ) {
		$delimiter_esc = preg_quote( $delimiter, '/' );
		$enclosure_esc = preg_quote( $enclosure, '/' );

		$output = [];
		foreach ( $fields as $field ) {
			if ( $field === null && $mysql_null ) {
				$output[] = 'NULL';
				continue;
			}

			$output[] = preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ? (
				$enclosure . str_replace( $enclosure, $enclosure . $enclosure, $field ) . $enclosure
			) : $field;
		}

		fwrite( $fh, join( $delimiter, $output ) . "\n" );
	}
}