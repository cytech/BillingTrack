@extends('layouts.master')

@section('content')
    {{--{!! Form::wobreadcrumbs() !!}--}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-fw fa-question-circle"></i>{{ trans('fi.about') }}
                </h3>
            </div>
            <div class="card-body">
                {{--cut and paste doc start--}}
                <p style="margin-bottom: 0in; line-height: 100%"><b>About Workorders
                        Timesheet</b></p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">This generates a
                    timesheet in the daterange specified including the company profile
                    specified.</p>
                <p style="margin-bottom: 0in; line-height: 100%">The data is
                    generated from:</p>
                <p style="margin-bottom: 0in; line-height: 100%">Invoices created
                    from Workorders (Workorder to Invoice).</p>
                <p style="margin-bottom: 0in; line-height: 100%">Workorder Employees
                    on the invoiced workorders and their time invoiced.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Table</b>:</p>
                <p style="margin-bottom: 0in; line-height: 100%">Generates a table of
                    results.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Report</b>:
                    (Timesheet report can also be accessed thru the FusionInvoice Reports
                    Menu)</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent; page-break-before: auto">
                    <b>Preview</b>:</p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Generates a preview table of results</p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <br/>

                </p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>PDF</b>:</p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Generates a PDF table of results</p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-left: 0.25in; margin-bottom: 0in; line-height: 100%; background: transparent; page-break-before: auto">
                    <b>Export</b> to Quickbooks Timer:</p>
                <p style="margin-bottom: 0in; line-height: 100%">	Generates an IIF
                    file that Quickbooks Desktop can import
                    (Quickbooks-File-Utilities-Import-Timer Activities)</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">	<b>Caveats</b>:</p>
                <p style="margin-bottom: 0in; line-height: 100%">	Employee name in
                    Workorder Employee MUST exactly match employee name in Quickbooks.</p>
                <p style="margin-bottom: 0in; line-height: 100%">	Employee in
                    Quickbooks MUST be assigned to “Hourly Wage” payroll item.</p>
                <p style="margin-bottom: 0in; line-height: 100%">	Only exports to a
                    single Quickbooks Company.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>	TO Configure:</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">	In order to
                    transfer time from Workorders TimeSheet to QuickBooks using IIF
                    files, you need to know the 	Company name and create time. This
                    information needs to be entered in the Workorder Settings. To find
                    this 	information in QuickBooks follow the steps below,</p>
                <p style="margin-bottom: 0in; line-height: 100%">   	 • Open
                    Quickbooks</p>
                <p style="margin-bottom: 0in; line-height: 100%">   	 • Goto
                    File-Utilities-Export-Timer List.</p>
                <p style="margin-bottom: 0in; line-height: 100%"> 	 • Save the file
                    to a location.</p>
                <p style="margin-bottom: 0in; line-height: 100%">  	 • Open the
                    file in Notepad.</p>
                <p style="margin-bottom: 0in; line-height: 100%">  	 • COMPANYNAME
                    can be found as the fourth entry on the headers on the first row. The
                    corresponding value 		on the row beneath it is the COMPANYNAME.</p>
                <p style="margin-bottom: 0in; line-height: 100%">	 •
                    COMPANYCREATETIME can be found as the last entry on the headers on
                    the first row. The corresponding 		value on the row beneath it is the
                    COMPANYCREATETIME.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>	Example</b>:</p>
                <p style="margin-bottom: 0in; line-height: 100%">	<font size="2" style="font-size: 10pt">!TIMERHDR	VER	REL	COMPANYNAME	IMPORTEDBEFORE	FROMTIMER	COMPANYCREATETIME</font></p>
                <p style="margin-bottom: 0in; line-height: 100%"><font size="2" style="font-size: 10pt">	TIMERHDR
                        8	 0	<b>YOURCOMPANYNAME</b>	N		Y		<b>123456789</b></font></p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">	Once you have this
                    information, goto Workorder-Utilities-Settings and enter the
                    information in the appropriate 	text boxes (at bottom of page) and
                    Save.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">	**************</p>
                {{--cut and paste doc end--}}
            </div>
        </div>
    </div>
@stop