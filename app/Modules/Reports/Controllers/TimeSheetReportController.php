<?php

/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Controllers;

use BT\Http\Controllers\Controller;
use BT\Modules\Reports\Reports\TimeSheetReport;
use BT\Modules\Reports\Requests\TimeSheetReportRequest;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Support\PDF\PDFFactory;
use Carbon\Carbon;

class TimeSheetReportController extends Controller
{
    private $timeSheetReport;

    public function __construct(
	    TimeSheetReport $timeSheetReport
    )
    {
        $this->timeSheetReport = $timeSheetReport;
    }

	public function report()
    {
	    $week_ini = new Carbon( "Monday last week" );
	    $week_end = new Carbon( "last Sunday" );

        return view('reports.options.timesheet_report', [
	        'fromDate' => $week_ini,
	        'toDate'   => $week_end,
	        'title'      => 'TimeSheet'
        ])
            ->with('companyProfiles', ['' => trans('bt.all_company_profiles')] + CompanyProfile::getList());
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

        return view('reports.output.timesheet_report')
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

        $html = view('reports.output.timesheet_report')
            ->with('results', $results)->render();

        $pdf->download($html, trans('bt.timesheet') .Date('Y-m-d'). '.pdf');
    }

	public function iif()
	{
		$results = $this->timeSheetReport->getResultsIIF(
			request('from_date'),
			request('to_date'),
			request('company_profile_id'));

		if ( ! count( $results['records'] ) ) {
			return redirect()->back()
			                 ->with( 'alert', trans('bt.timesheet_nodata_alert') );
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
