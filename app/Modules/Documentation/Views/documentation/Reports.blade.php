@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Reports</h2>

        <hr>

        {{--<p><a href="#create-quote">How do I create a quote?</a></p>--}}
        {{--<p><a href="#email-quote">How do I email a quote?</a></p>--}}
        {{--<p><a href="#convert-to-invoice">How do I convert a quote to an invoice?</a></p>--}}
        {{--<p><a href="#copy-quote">How do I copy a quote?</a></p>--}}
        {{--<p><a href="#attach-files-quote">How do I attach files to a quote?</a></p>--}}
        <p><a href="#timesheet-report">Timesheet Report</a></p>

        <hr>

        <span class="anchor" id="timesheet-report"></span>
        <h3>Timesheet Report</h3>
        <p>
        <p style="margin-bottom: 0; line-height: 100%"><b>About Workorders
                Timesheet</b></p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%">This generates a
            timesheet in the daterange specified including the company profile
            specified.</p>
        <p style="margin-bottom: 0; line-height: 100%">The data is
            generated from:</p>
        <p style="margin-bottom: 0; line-height: 100%">Invoices created
            from Workorders (Workorder to Invoice).</p>
        <p style="margin-bottom: 0; line-height: 100%">Workorder Employees
            on the invoiced workorders and their time invoiced.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Table</b>:</p>
        <p style="margin-bottom: 0; line-height: 100%">Generates a table of
            results.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Report</b>:
            (Timesheet report can also be accessed thru the FusionInvoice Reports
            Menu)</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent; page-break-before: auto">
            <b>Preview</b>:</p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent">
            Generates a preview table of results</p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent">
            <br/>

        </p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent">
            <b>PDF</b>:</p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent">
            Generates a PDF table of results</p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent">
            <br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-left: 0.25in; margin-bottom: 0; line-height: 100%; background: transparent; page-break-before: auto">
            <b>Export</b> to Quickbooks Timer:</p>
        <p style="margin-bottom: 0; line-height: 100%">	Generates an IIF
            file that Quickbooks Desktop can import
            (Quickbooks-File-Utilities-Import-Timer Activities)</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%">	<b>Caveats</b>:</p>
        <p style="margin-bottom: 0; line-height: 100%">	Employee name in
            Workorder Employee MUST exactly match employee name in Quickbooks.</p>
        <p style="margin-bottom: 0; line-height: 100%">	Employee in
            Quickbooks MUST be assigned to “Hourly Wage” payroll item.</p>
        <p style="margin-bottom: 0; line-height: 100%">	Only exports to a
            single Quickbooks Company.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>	TO Configure:</b></p>
        <p style="margin-bottom: 0; line-height: 100%">	In order to
            transfer time from Workorders TimeSheet to QuickBooks using IIF
            files, you need to know the 	Company name and create time. This
            information needs to be entered in the Workorder Settings. To find
            this 	information in QuickBooks follow the steps below,</p>
        <p style="margin-bottom: 0; line-height: 100%">   	 • Open
            Quickbooks</p>
        <p style="margin-bottom: 0; line-height: 100%">   	 • Goto
            File-Utilities-Export-Timer List.</p>
        <p style="margin-bottom: 0; line-height: 100%"> 	 • Save the file
            to a location.</p>
        <p style="margin-bottom: 0; line-height: 100%">  	 • Open the
            file in Notepad.</p>
        <p style="margin-bottom: 0; line-height: 100%">  	 • COMPANYNAME
            can be found as the fourth entry on the headers on the first row. The
            corresponding value 		on the row beneath it is the COMPANYNAME.</p>
        <p style="margin-bottom: 0; line-height: 100%">	 •
            COMPANYCREATETIME can be found as the last entry on the headers on
            the first row. The corresponding 		value on the row beneath it is the
            COMPANYCREATETIME.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>	Example</b>:</p>
        <p style="margin-bottom: 0; line-height: 100%">	<font size="2" style="font-size: 10pt">!TIMERHDR	VER	REL	COMPANYNAME	IMPORTEDBEFORE	FROMTIMER	COMPANYCREATETIME</font></p>
        <p style="margin-bottom: 0; line-height: 100%"><font size="2" style="font-size: 10pt">	TIMERHDR
                8	 0	<b>YOURCOMPANYNAME</b>	N		Y		<b>123456789</b></font></p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%">	Once you have this
            information, goto Workorder-Utilities-Settings and enter the
            information in the appropriate 	text boxes (at bottom of page) and
            Save.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%">	**************</p>


        {{--<span class="anchor" id="create-quote"></span>--}}
        {{--<h3>How do I create a quote?</h3>--}}

        {{--<p>Click the Quotes menu item and press the New button.</p>--}}
        {{--<a href="/img/documentation/quote_create.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_create_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<p>The Create Quote screen will prompt you for the client name, quote date, company profile and group.</p>--}}
        {{--<p>If the quote is for a new client, type the client's name in full. You will be able to edit the other details--}}
            {{--for this client record from the next screen. If the quote is for an existing client, start typing the--}}
            {{--client's--}}
            {{--name and you will be able to select your existing client from the list that appears.</p>--}}
        {{--<p>The date defaults to today's date but can be changed if necessary.</p>--}}
        {{--<p>The company profile is where the quote will pull your company name, address, phone number, and other company--}}
            {{--specific details from.</p>--}}
        {{--<p>The group controls the format of the number assigned to each quote.</p>--}}
        {{--<p>Press Submit when done and you'll be taken to the Quote Edit screen.</p>--}}

        {{--<a href="/img/documentation/quote_create2.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_create2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<p>The Quote Edit screen is where you'll add line items as well as define further properties and options--}}
            {{--for your quote.</p>--}}
        {{--<p><strong>1. Summary</strong></p>--}}
        {{--<p>Entering a brief summary or description of the quote will make the quote easier to find and search for.</p>--}}

        {{--<p><strong>2. From/To</strong></p>--}}
        {{--<p>The from and to areas display who the quote is issued from and who the quote is being sent to. If you--}}
            {{--created the quote with the wrong company profile selected by mistake, you can easily change that by pressing--}}
            {{--the Change button on the From area and choose the correct company profile. Similarly, if you created the--}}
            {{--quote--}}
            {{--with the wrong client selected, you can easily correct that by pressing the Change button on the To area and--}}
            {{--choose--}}
            {{--the correct client.</p>--}}

        {{--<p><strong>3. Items</strong></p>--}}
        {{--<p>This is where you'll enter each of your line items. Press the Add Item button to add additional lines for--}}
            {{--your items.</p>--}}

        {{--<p><strong>4. Additional, Notes and Attachments</strong></p>--}}
        {{--<p>Terms and conditions as well as text to appear in the footer of your quote may be entered on the Additional--}}
            {{--tab. Defaults--}}
            {{--for these fields may be set in System Settings on the Quotes tab (default values for these fields will not--}}
            {{--appear on quotes--}}
            {{--already created).</p>--}}
        {{--<p>Public or private notes may be entered on the Notes tab. Notes entered on this tab will be visible to clients--}}
            {{--viewing--}}
            {{--the quote using the public link unless they are marked as private. Clients may leave notes on a quote when--}}
            {{--viewing--}}
            {{--the quote using the public link as well.</p>--}}
        {{--<p>File attachments may be uploaded to a quote on the Attachments tab. See <a href="#attach-files-quote">How do--}}
                {{--I attach files--}}
                {{--to a quote?</a> for details.--}}
        {{--<p><strong>5. Options</strong></p>--}}
        {{--<p>A number of other options and values are defined in the options area.</p>--}}
        {{--<ul>--}}
            {{--<li>Quote # - This is generated according to the group selected when the quote was created.</li>--}}
            {{--<li>Date - The date the quote was issued.</li>--}}
            {{--<li>Expires - The date the price reflected on the quote expires.</li>--}}
            {{--<li>Discount - A percentage based discount can be applied to the quote.</li>--}}
            {{--<li>Currency - The currency the quote will be issued in. The default currency can be changed on both the--}}
                {{--client--}}
                {{--record and in System Settings. If the client record has a different currency than System Settings, the--}}
                {{--currency on the client--}}
                {{--record will override System Settings.--}}
            {{--</li>--}}
            {{--<li>Exchange Rate - If a currency other than your base currency is selected, the exchange rate will--}}
                {{--automatically update--}}
                {{--itself based on the current rate.--}}
            {{--</li>--}}
            {{--<li>Status - The current status of the quote. Once a quote has been emailed, the status will automatically--}}
                {{--update itself to Sent. If--}}
                {{--a client has accepted or rejected a quote from the public quote link, it will update itself to the--}}
                {{--appropriate status.--}}
            {{--</li>--}}
            {{--<li>Template - This is the template the quote will use when viewed using the public link or when generating--}}
                {{--the quote PDF. The--}}
                {{--default template can be changed on both the client record and in System Settings. If the client record--}}
                {{--has a different default template--}}
                {{--than System Settings, the client record will override System Settings. This behavior allows you use a--}}
                {{--specific template as default--}}
                {{--for most of your quotes while specifying a different template for a particular client or clients.--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<a href="/img/documentation/quote_edit.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_edit_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<hr>--}}

        {{--<span class="anchor" id="email-quote"></span>--}}
        {{--<h3>How do I email a quote?</h3>--}}

        {{--<p>Press the Email button from the Quote Edit screen.</p>--}}
        {{--<p style="font-style: italic;">* Note that the Email button will not appear unless you have configured your--}}
            {{--email settings in System--}}
            {{--Settings on the Email tab.</p>--}}

        {{--<a href="/img/documentation/quote_email.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_email_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<p>The Email Quote screen allows you to add additional recipients, change the subject and / or body, if--}}
            {{--necessary.</p>--}}
        {{--<p>Press the Send button to send the email.</p>--}}

        {{--<a href="/img/documentation/quote_email2.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_email2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<hr>--}}

        {{--<span class="anchor" id="convert-to-invoice"></span>--}}
        {{--<h3>How do I convert a quote to an invoice?</h3>--}}

        {{--<p>Once a client has accepted your quote, you can convert it to an invoice on the Quote Edit screen by clicking--}}
            {{--the Options button and choosing Quote to Invoice.</p>--}}

        {{--<a href="/img/documentation/quote_to_invoice.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_to_invoice_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<p>Review the date and group, adjust if necessary and press the Submit button. Once submitted, you will--}}
            {{--be taken to the Invoice Edit screen for the new invoice.</p>--}}

        {{--<a href="/img/documentation/quote_to_invoice2.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_to_invoice2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<hr>--}}

        {{--<span class="anchor" id="copy-quote"></span>--}}
        {{--<h3>How do I copy a quote?</h3>--}}

        {{--<p>Press the Other button and choose Copy from the Quote Edit screen.</p>--}}

        {{--<a href="/img/documentation/quote_copy.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_copy_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<p>Change the client's name if the copy will be for a different client.</p>--}}
        {{--<p>Review the date, company profile, and group. Change if necessary.</p>--}}
        {{--<p>Press the Submit button to complete the copy.</p>--}}

        {{--<a href="/img/documentation/quote_copy2.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_copy2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        {{--<hr>--}}

        {{--<span class="anchor" id="attach-files-quote"></span>--}}
        {{--<h3>How do I attach files to a quote?</h3>--}}

        {{--<p>Files of any type may be uploaded as an attachment to a quote by clicking the Attachments tab on--}}
            {{--the Quote Edit screen and pressing the Attach File button.</p>--}}
        {{--<p>The Client Visibility option may be adjusted for each file attachment to determine whether or not the--}}
            {{--client should be able to access and download the attachment when viewing the quote public link. The--}}
            {{--following Client Visibility options are available for quote attachments:</p>--}}
        {{--<ul>--}}
            {{--<li>Visible - Clients will be able to access this attachment from the quote public link.</li>--}}
            {{--<li>Not Visible - Clients will not be able to access this attachment from the quote public link.</li>--}}
        {{--</ul>--}}

        {{--<p style="font-style: italic;">* Note that attachments uploaded to a quote do not "attach" themselves to the--}}
            {{--quote--}}
            {{--PDF output. Quote attachments are intended to provide an easy way to deliver digital assets related to a--}}
            {{--quote--}}
            {{--to your clients (or just to store related files for your own purposes).</p>--}}

        {{--<a href="/img/documentation/quote_attachments.png" target="_blank">--}}
            {{--<img src="/img/documentation/quote_attachments_small.png" class="img-responsive">--}}
        {{--</a>--}}

    </div>

@stop