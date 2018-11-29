@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Reports</h2>

        <hr>

        {{--<p><a href="#clientstatement-report">Client Statement Report</a></p>--}}
        {{--<p><a href="#expenselist-report">Expense List Report</a></p>--}}
        {{--<p><a href="#itemsales-report">Item Sales Report</a></p>--}}
        {{--<p><a href="#paymentscollected-report">Payments Collected Report</a></p>--}}
        {{--<p><a href="#profitandloss-report">Profit and Loss Report</a></p>--}}
        {{--<p><a href="#revenuebyclient-report">Revenue by Client Report</a></p>--}}
        {{--<p><a href="#taxsummary-report">Tax Summary Report</a></p>--}}
        {{--<p><a href="#timetracking-report">Time Tracking Report</a></p>--}}
        {{--<p><a href="#timesheet-report">Timesheet Report</a></p>--}}

        <hr>
        <span class="anchor" id="clientstatement-report"></span>
        <h3>Client Statement Report</h3>
        <br>
        <span class="anchor" id="expenselist-report"></span>
        <h3>Expense List Report</h3>
        <br>
        <span class="anchor" id="itemsales-report"></span>
        <h3>Item Sales Report</h3>
        <br>
        <span class="anchor" id="paymentscollected-report"></span>
        <h3>Payments Collected Report</h3>
        <br>
        <span class="anchor" id="profitandloss-report"></span>
        <h3>Profit and Loss Report</h3>
        <br>
        <span class="anchor" id="revenuebyclient-report"></span>
        <h3>Revenue by Client Report</h3>
        <br>
        <span class="anchor" id="taxsummary-report"></span>
        <h3>Tax Summary Report</h3>
        <br>
        <span class="anchor" id="timetracking-report"></span>
        <h3>Time Tracking Report</h3>
        <br>
        <span class="anchor" id="timesheet-report"></span>
        <h3>Timesheet Report</h3>
        <p>
        </p>
        <p>This generates a
            timesheet in the daterange specified including the company profile
            specified.</p>
        <p>The data is
            generated from:</p>
        <ul>
            <li>Invoices created
                from Workorders (Workorder to Invoice).
            </li>
            <li>Workorder Employees
                on the invoiced workorders and their time invoiced.
            </li>
        </ul>

        <p>
            <b>Preview</b>:</p>
        <p>
            Generates a preview table of results</p>
        <p>


        </p>
        <p>
            <b>PDF</b>:</p>
        <p>
            Generates a PDF table of results</p>
        <p>


        </p>
        <p>

        </p>
        <p>
            <b>Export to Quickbooks Timer:</b></p>
        <p> Generates an IIF
            file that Quickbooks Desktop can import
            (Quickbooks-File-Utilities-Import-Timer Activities)</p>
        <p>

        </p>
        <ul>
            <li><b>Caveats</b>:</li>
            <li> Employee name in
                Workorder Employee MUST exactly match employee name in Quickbooks.
            </li>
            <li> Employee in
                Quickbooks MUST be assigned to “Hourly Wage” payroll item.
            </li>
            <li> Only exports to a
                single Quickbooks Company.
            </li>
            <br>
            <li><b> TO Configure:</b></li>
            <li> In order to
                transfer time from Workorders TimeSheet to QuickBooks using IIF
                files, you need to know the Company name and create time. This
                information needs to be entered in the System Settings - Workorder tab. To find
                this information in QuickBooks follow the steps below,
            </li>
            <li>Open
                Quickbooks
            </li>
            <li>Goto
                File-Utilities-Export-Timer List.
            </li>
            <li>Save the file
                to a location.
            </li>
            <li>Open the
                file in Notepad.
            </li>
            <li>COMPANYNAME
                can be found as the fourth entry on the headers on the first row. The
                corresponding value on the row beneath it is the COMPANYNAME.
            </li>
            <li>
                COMPANYCREATETIME can be found as the last entry on the headers on
                the first row. The corresponding value on the row beneath it is the
                COMPANYCREATETIME.
            </li>
            <br>
            <li><b> Example</b>:</li>
            <li>!TIMERHDR VER REL COMPANYNAME IMPORTEDBEFORE FROMTIMER
                COMPANYCREATETIME
            </li>
            <li> TIMERHDR
                8 0 <b>YOURCOMPANYNAME</b> N Y <b>123456789</b></li>
            <br>
            <li> Once you have this
                information, goto System Settings - Workorder tab and enter the
                information in the appropriate text boxes (at bottom of page) and
                Save.
            </li>

        </ul>

    </div>

@stop