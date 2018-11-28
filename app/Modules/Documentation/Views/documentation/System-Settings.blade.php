@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>System Settings</h2>

        <hr>

        <h3>General</h3>

        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Header Title Text</td>
                <td>This text displays in the top left hand side of the window.</td>
                <td>FusionInvoice</td>
            </tr>
            <tr>
                <td>Default Company Profile</td>
                <td>If using more than one company profile, a default may be set. This default company profile will be
                    selected when creating quotes and invoices.
                </td>
                <td>Defaults to the initial company profile created during installation.</td>
            </tr>
            <tr>
                <td>Version</td>
                <td>The current version of your installation. Pressing the Check for Update button will check to see if
                    any
                    updates are currently available.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Skin</td>
                <td>Multiple skins are available which control the color scheme of your installation.</td>
                <td>fusioninvoice</td>
            </tr>
            <tr>
                <td>Language</td>
                <td>The default system language. The language may also be set per client so they can see their quotes,
                    invoices and Client Center
                    in their own language.
                </td>
                <td>en</td>
            </tr>
            <tr>
                <td>Date Format</td>
                <td>The format in which to render dates.</td>
                <td>m/d/Y</td>
            </tr>
            <tr>
                <td>Use 24 Hour Time Format</td>
                <td>This is currently used only for the Time Tracking add-on.</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Timezone</td>
                <td>The default system timezone.</td>
                <td></td>
            </tr>
            <tr>
                <td>Display Client Unique Name</td>
                <td>By default, the Client Unique Name field displays only when a client name is not unique. You may
                    choose to always display the Client Unique Name field instead.
                </td>
                <td>Only When the Client Name is Not Unique</td>
            </tr>
            <tr>
                <td>Address Format</td>
                <td>
                    <p>If you enter addresses into the individual address fields (Address, City, State, Postal Code,
                        etc), then
                        the Address Format might be entered as such:</p>
                    <p>@{{ address }}<br>@{{ city }}, @{{ state }} @{{ postal_code }}</p>
                    <p>If you enter the entire address into the single Address field already in the format which you
                        want it to display, then
                        the Address Format should be entered as such:</p>
                    <p>@{{ address }}</p>
                </td>
                <td>@{{ address }}<br>@{{ city }}, @{{ state }} @{{ postal_code }}</td>
            </tr>
            <tr>
                <td>Number of Decimals for Quantities and Amounts</td>
                <td>The number of decimals available in the quantity and amount fields.</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Number of Decimals for Tax Rounding</td>
                <td>The number of decimals used when rounding calculated tax amounts.</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Base Currency</td>
                <td>The default system currency. The currency may also be set per client.</td>
                <td>US Dollar</td>
            </tr>
            <tr>
                <td>Exchange Rate Mode</td>
                <td>If set to Automatic, the exchange rate will automatically adjust itself on a quote or invoice when
                    the quote or invoice
                    is set to a currency other than the base currency. If set to Manual, then it expects it will be
                    manually entered.
                </td>
                <td>Automatic</td>
            </tr>
            <tr>
                <td>Results Per Page</td>
                <td>The number of results per page to display on list pages (clients, quotes, invoices, payments,
                    etc).
                </td>
                <td>15</td>
            </tr>
        </table>

        <h3>Invoices</h3>

        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Default Invoice Template</td>
                <td>The default system invoice template. The template may also be set per invoice.</td>
                <td>default.blade.php</td>
            </tr>
            <tr>
                <td>Default Group</td>
                <td>The default system invoice group. The group may be overridden when creating a new invoice.</td>
                <td>Invoice Default</td>
            </tr>
            <tr>
                <td>Invoices Due After (Days)</td>
                <td>The number of days after the invoice date which an invoice is due. This value is required and must
                    be numeric.
                </td>
                <td>30</td>
            </tr>
            <tr>
                <td>Default Status Filter</td>
                <td>Visiting the Invoices list will list invoices of this status by default.</td>
                <td>All Statuses</td>
            </tr>
            <tr>
                <td>Default Terms</td>
                <td>Default terms may be entered so they are automatically filled in on newly created invoices. Changing
                    the default terms does not affect previously created invoices.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Default Footer</td>
                <td>Default footer text may be entered so it is automatically filled in on newly created invoices.
                    Changing
                    the default footer does not affect previously created invoices.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Automatically Email Recurring Invoices</td>
                <td>Determines whether newly generated recurring invoices are automatically emailed.</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Automatically Email Payment Receipts</td>
                <td>Determines whether payment receipts are automatically emailed when online payments are made. Also
                    determines whether or not the Email Payment Receipt checkbox is checked by default when manually
                    entering
                    a payment.
                </td>
                <td>No</td>
            </tr>
            <tr>
                <td>Online Payment Method</td>
                <td>When an online payment is made, this is the payment method which will be assigned to the payment.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Allow Entering Payments on Invoices Without Balance</td>
                <td>If you'd like to allow overpayments to be entered on invoices, set to Yes.</td>
                <td>No</td>
            </tr>
            <tr>
                <td><span class="anchor" id="invoice-email-while-draft"></span>If Invoice is Emailed While in Draft
                    Status
                </td>
                <td>Depending on your workflow, you may want the date of an invoice which is in draft status to
                    automatically set itself to the current date prior to being emailed.
                </td>
                <td>Keep Invoice Date As Is</td>
            </tr>
        </table>

        <h3>Quotes</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Default Quote Template</td>
                <td>The default system quote template. The template may also be set per quote.</td>
                <td>default.blade.php</td>
            </tr>
            <tr>
                <td>Default Group</td>
                <td>The default system quote group. The group may be overridden when creating a new quote.</td>
                <td>Quote Default</td>
            </tr>
            <tr>
                <td>Quotes Expire After (Days)</td>
                <td>The number of days after the quote date which a quote expires. This value is required and must be
                    numeric.
                </td>
                <td>15</td>
            </tr>
            <tr>
                <td>Default Status Filter</td>
                <td>Visiting the Invoices list will list invoices of this status by default.</td>
                <td>All Statuses</td>
            </tr>
            <tr>
                <td>Automatically Convert Quote to Invoice When Client Approves</td>
                <td>Determines whether or not a quote should be automatically converted to an invoice once a client
                    approves the quote through the quote's public link.
                </td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>When a Quote Is Converted to An Invoice</td>
                <td>An invoice converted from a quote may either retain the terms which were entered on the quote or it
                    may use the default invoice terms.
                </td>
                <td>The invoice should retain the terms from the quote</td>
            </tr>
            <tr>
                <td>Default Terms</td>
                <td>Default terms may be entered so they are automatically filled in on newly created quotes. Changing
                    the default terms does not affect previously created quotes.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Default Footer</td>
                <td>Default footer text may be entered so it is automatically filled in on newly created quotes.
                    Changing
                    the default footer does not affect previously created quotes.
                </td>
                <td></td>
            </tr>
            <tr>
                <td><span class="anchor" id="quote-email-while-draft"></span>If Quote is Emailed While in Draft Status
                </td>
                <td>Depending on your workflow, you may want the date of a quote which is in draft status to
                    automatically set itself to the current date prior to being emailed.
                </td>
                <td>Keep Quote Date As Is</td>
            </tr>
        </table>

        <h3>Taxes</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Default Item Tax Rate</td>
                <td>If entered, this tax rate will be set as the default Tax 1 on any new items added to a quote or
                    invoice.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Default Item Tax 2 Rate</td>
                <td>If entered, this tax rate will be set as the default Tax 2 on any new items added to a quote or
                    invoice.
                </td>
                <td></td>
            </tr>
        </table>

        <h3>Email</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Email Sending Method</td>
                <td>This is the method the system will use to deliver email.</td>
                <td></td>
            </tr>
            <tr>
                <td>SMTP Host Address</td>
                <td>If SMTP is selected as the email sending method, enter the SMTP server address.</td>
                <td></td>
            </tr>
            <tr>
                <td>SMTP Host Port</td>
                <td>If SMTP is selected as the email sending method, enter the SMTP port.</td>
                <td></td>
            </tr>
            <tr>
                <td>SMTP Username</td>
                <td>If SMTP is selected as the email sending method, enter the SMTP account username.</td>
                <td></td>
            </tr>
            <tr>
                <td>SMTP Password</td>
                <td>If SMTP is selected as the email sending method, enter the SMTP account password.</td>
                <td></td>
            </tr>
            <tr>
                <td>SMTP Encryption</td>
                <td>If SMTP is selected as the email sending method, select the appropriate form of encryption.</td>
                <td></td>
            </tr>
            <tr>
                <td><span class="anchor" id="email-allow-self-signed-cert"></span>Allow Self-Signed Certificate</td>
                <td>If you are using a self-signed certificate and receive a certificate error when sending email,
                    set this value to Yes. Otherwise, keep it set to No.
                </td>
                <td>No</td>
            </tr>
            <tr>
                <td>Always Attach PDF</td>
                <td>When set to Yes, all automatic outgoing email will attach the invoice or quote PDF.</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Reply To Address</td>
                <td>This will set the reply to header in outgoing email.</td>
                <td></td>
            </tr>
            <tr>
                <td>Always CC Address</td>
                <td>When present, the address entered will always be selected as a CC recipient of every outgoing
                    email.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Always BCC Address</td>
                <td>When present, the address entered will always be selected as a BCC recipient of every outgoing
                    email.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Quote Email Subject</td>
                <td>The customizable, default subject for outgoing quote emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Default Quote Email Body</td>
                <td>The customizable, default body for outgoing quote emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Invoice Email Subject</td>
                <td>The customizable, default subject for outgoing invoice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Default Invoice Email Body</td>
                <td>The customizable, default body for outgoing invoice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Overdue Email Subject</td>
                <td>The customizable, default subject for outgoing overdue invoice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Default Overdue Invoice Email Body</td>
                <td>The customizable, default body for outgoing overdue invoice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Upcoming Payment Notice Email Receipt Subject</td>
                <td>The customizable subject for outgoing payment notice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Upcoming Payment Notice Email Body</td>
                <td>The customizable body for outgoing payment notice emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Overdue Invoice Reminder Frequency</td>
                <td>A comma separated list of days after an invoice is due to send the reminder. Leave empty to disable
                    overdue invoice reminders. For example, a value of 1,5,10 would send reminders 1, 5 and 10 days
                    after the invoice is due.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Upcoming Payment Notice Frequency</td>
                <td>A comma separated list of days before an invoice is due to send the reminder. Leave empty to disable
                    upcoming payment notices. For example, a value of 1,5 would send notices 1 and 5 days before the
                    invoice is due.
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Quote Approved Email Body</td>
                <td>The customizable body for outgoing quote approved emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Quote Rejected Email Body</td>
                <td>The customizable body for outgoing quote rejected emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Payment Receipt Email Subject</td>
                <td>The customizable, default subject for outgoing payment receipt emails.</td>
                <td></td>
            </tr>
            <tr>
                <td>Default Payment Receipt Body</td>
                <td>The customizable, default body for outgoing payment receipt emails.</td>
                <td></td>
            </tr>
        </table>

        <h3>PDF</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Paper Size</td>
                <td>The PDF paper size.</td>
                <td>Letter</td>
            </tr>
            <tr>
                <td>Paper Orientation</td>
                <td>The PDF paper orientation.</td>
                <td>Portrait</td>
            </tr>
            <tr>
                <td>PDF Driver</td>
                <td>The library used to generate PDF's.</td>
                <td>domPDF</td>
            </tr>
            <tr>
                <td>Binary Path</td>
                <td>When wkhtmltopdf is selected as the PDF driver, the path to the wkhtmltopdf executable should be
                    entered.
                </td>
                <td></td>
            </tr>
        </table>

        <h3>Online Payments</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td>Mollie</td>
                <td>These settings are used to configure the Mollie online payment integration.</td>
                <td></td>
            </tr>
            <tr>
                <td>PayPal</td>
                <td>These settings are used to configure the PayPal online payment integration.</td>
                <td></td>
            </tr>
            <tr>
                <td>Stripe</td>
                <td>These settings are used to configure the Stripe online payment integration.</td>
                <td></td>
            </tr>
        </table>

        <h3>Backup</h3>
        <table class="table">
            <tr>
                <th style="width: 30%;">Setting</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Default</th>
            </tr>
            <tr>
                <td><span class="anchor" id="backup-database"></span>Download Database Backup</td>
                <td>This button will create a full .sql file backup of your FusionInvoiceFOSS database for download.</td>
                <td></td>
            </tr>
        </table>

    </div>
@stop