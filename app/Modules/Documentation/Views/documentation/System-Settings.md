System Settings
---

---

### General

| Setting                                                                                                                  | Description                                                                                                                                                                                                                                                                                                                                                                                                 | Default                                                              |
|:-------------------------------------------------------------------------------------------------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------------------------------|
| Header Title Text                                                                                                        | This text displays in the top left hand side of the window.                                                                                                                                                                                                                                                                                                                                                 | BillingTrack                                                         |
| Default Company Profile                                                                                                  | If using more than one company profile, a default may be set. This default company profile will be selected when creating quotes and invoices.                                                                                                                                                                                                                                                              | Defaults to the initial company profile created during installation. |
| Version                                                                                                                  | The current version of your installation. Pressing the Check for Update button will check to see if any updates are currently available.                                                                                                                                                                                                                                                                    |                                                                      |
| Language                                                                                                                 | The default system language. The language may also be set per client so they can see their quotes, invoices and Client Center in their own language.                                                                                                                                                                                                                                                        | en                                                                   |
| Date Format                                                                                                              | The format in which to render dates.                                                                                                                                                                                                                                                                                                                                                                        | m/d/Y                                                                |
| Use 24 Hour Time Format                                                                                                  | This is currently used only for the Time Tracking add-on.                                                                                                                                                                                                                                                                                                                                                   | No                                                                   |
| Timezone                                                                                                                 | The default system timezone.                                                                                                                                                                                                                                                                                                                                                                                |                                                                      |
| Skin Header Background, Skin Header Text Contrast, Skin Menu background, Skin Menu Text Contrast, Skin Menu Default Mode | Multiple skin definitions are available which control the color scheme of your installation.                                                                                                                                                                                                                                                                                                                | purple,dark,white,light,open                                         |
| Display Client Unique Name                                                                                               | By default, the Client Unique Name field displays only when a client name is not unique. You may choose to always display the Client Unique Name field instead.                                                                                                                                                                                                                                             | Only When the Client Name is Not Unique                              |
| Address Format                                                                                                           | If you enter addresses into the individual address fields (Address, City, State, Postal Code, etc), then the Address Format might be entered as such:<br> {{address}}<br>{{ city }}, {{ state }} {{ postal_code }}<br>If you enter the entire address into the single Address field already in the format which you want it to display, then the Address Format should be entered as such:<br>{{ address }} | {{ address }}<br>{{ city }}, {{ state }} {{ postal_code }}           |
| Number of Decimals for Quantities and Amounts                                                                            | The number of decimals available in the quantity and amount fields.                                                                                                                                                                                                                                                                                                                                         | 2                                                                    |
| Number of Decimals for Tax Rounding                                                                                      | The number of decimals used when rounding calculated tax amounts.                                                                                                                                                                                                                                                                                                                                           | 3                                                                    |
| Base Currency                                                                                                            | The default system currency. The currency may also be set per client.                                                                                                                                                                                                                                                                                                                                       | US Dollar                                                            |
| FixerIO API Key                                                                                                          | To use currency exchange rates in BillingTrack, you have to signup for a (free) API Key at https://fixer.io                                                                                                                                                                                                                                                                                                 | null                                                                 |
| Exchange Rate Mode                                                                                                       | If set to Automatic, the exchange rate will automatically adjust itself on a quote or invoice when the quote or invoice is set to a currency other than the base currency. If set to Manual, then it expects it will be manually entered.                                                                                                                                                                   | Automatic                                                            |
| Results Per Page - Deprecated                                                                                            | The number of results per page to display on list pages (clients, quotes, invoices, payments, etc).                                                                                                                                                                                                                                                                                                         | 15                                                                   |
| Push active Products to Item Lookups                                                                                     | If set to yes, automatically updates Item Lookup Table when there is a modification to the Products table. Also allows user to force the update.                                                                                                                                                                                                                                                            | No                                                                   |
| Push active Employees to Item Lookups                                                                                    | If set to yes, automatically updates Item Lookup Table when there is a modification to the Employees table. Also allows user to force the update.                                                                                                                                                                                                                                                           | No                                                                   |
| Force HTTPS                                                                                                              | Prior to enabling this option, be sure your BillingTrack installation is functional via https. Failure to do so may result in a non-functional (but fixable) installation.                                                                                                                                                                                                                                  | No                                                                   |

To use currency exchange rates in BillingTrack, you have to signup for a (free) API key at https://fixer.io.
### Dashboard

| Setting                  | Description                                                | Default |
|:-------------------------|:-----------------------------------------------------------|:--------|
| Display Profile Image    | Displays profile image and name in upper left of side menu | Yes     |
| List of available limits | Options for any available widgets in the system            |         |


### Quotes
| Setting                | Description                                                                | Default           |
|:-----------------------|:---------------------------------------------------------------------------|:------------------|
| Default Quote Template | The default system quote template. The template may also be set per quote. | default.blade.php |
|Default Group|The default system quote group. The group may be overridden when creating a new quote.|Quote Default|
|Quotes Expire After (Days)|The number of days after the quote date which a quote expires. This value is required and must be numeric.|15|
|Default Status Filter|Visiting the Invoices list will list invoices of this status by default.|All Statuses|
|Automatically Convert Quote to Invoice When Client Approves|Determines whether or not a quote should be automatically converted to an invoice once a client approves the quote through the quote's public link.|Yes|
|When a Quote Is Converted to An Invoice|An invoice converted from a quote may either retain the terms which were entered on the quote or it may use the default invoice terms.|The invoice should retain the terms from the quote|
|Default Terms|Default terms may be entered so they are automatically filled in on newly created quotes. Changing the default terms does not affect previously created quotes.| |
|Default Footer|Default footer text may be entered so it is automatically filled in on newly created quotes. Changing the default footer does not affect previously created quotes.| |
|<span id="quote-email-while-draft" class="anchor"></span>If Quote is Emailed While in Draft Status|Depending on your workflow, you may want the date of a quote which is in draft status to automatically set itself to the current date prior to being emailed.|Keep Quote Date As Is|

### Workorders
| Setting                | Description                                                                | Default           |
|:-----------------------|:---------------------------------------------------------------------------|:------------------|
| Default Workorder Template | The default system workorder template. The template may also be set per workorder. | default.blade.php |
|Default Group|The default system workorder group. The group may be overridden when creating a new workorder.|Workorder Default|
|Workorders Expire After (Days)|The number of days after the workorder date which a workorder expires. This value is required and must be numeric.|15|
|Default Status Filter|Visiting the Invoices list will list invoices of this status by default.|All Statuses|
|Automatically Convert Workorder to Invoice When Client Approves|Determines whether or not a workorder should be automatically converted to an invoice once a client approves the workorder through the workorder's public link.|Yes|
|When a Workorder Is Converted to An Invoice|An invoice converted from a workorder may either retain the terms which were entered on the workorder or it may use the default invoice terms.|The invoice should retain the terms from the workorder|
|Default Terms|Default terms may be entered so they are automatically filled in on newly created workorders. Changing the default terms does not affect previously created workorders.| |
|Default Footer|Default footer text may be entered so it is automatically filled in on newly created workorders. Changing the default footer does not affect previously created workorders.| |
|<span id="workorder-email-while-draft" class="anchor"></span>If Workorder is Emailed While in Draft Status|Depending on your workflow, you may want the date of a workorder which is in draft status to automatically set itself to the current date prior to being emailed.|Keep Workorder Date As Is|

### Invoices
| Setting                | Description                                                                | Default           |
|:-----------------------|:---------------------------------------------------------------------------|:------------------|
|Default Invoice Template|The default system invoice template. The template may also be set per invoice.|default.blade.php|
|Default Group|The default system invoice group. The group may be overridden when creating a new invoice.|Invoice Default|
|Invoices Due After (Days)|The number of days after the invoice date which an invoice is due. This value is required and must be numeric.|30|
|Default Status Filter|Visiting the Invoices list will list invoices of this status by default.|All Statuses|
|Default Terms|Default terms may be entered so they are automatically filled in on newly created invoices. Changing the default terms does not affect previously created invoices.| |
|Default Footer|Default footer text may be entered so it is automatically filled in on newly created invoices. Changing the default footer does not affect previously created invoices.| |
|Automatically Email Recurring Invoices|Determines whether newly generated recurring invoices are automatically emailed.|Yes|
|Automatically Email Payment Receipts|Determines whether payment receipts are automatically emailed when online payments are made. Also determines whether or not the Email Payment Receipt checkbox is checked by default when manually entering a payment.|No|
|Online Payment Method|When an online payment is made, this is the payment method which will be assigned to the payment.| |
|Allow Entering Payments on Invoices Without Balance|If you'd like to allow overpayments to be entered on invoices, set to Yes.|No|
|<span id="invoice-email-while-draft" class="anchor"></span>If Invoice is Emailed While in Draft Status|Depending on your workflow, you may want the date of an invoice which is in draft status to automatically set itself to the current date prior to being emailed.|Keep Invoice Date As Is|

### Purchaseorders
| Setting                           | Description                                                                                                                                           | Default                                      |
|:----------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------|
| Default Purchaseorder Template    | The default system purchaseorder template. The template may also be set per purchaseorder.                                                            | default.blade.php                            |
| Default Group                     | The default system purchaseorder group. The group may be overridden when creating a new purchaseorder.                                                | Purchaseorder Default                        |
| Purchaseorders Due After (Days)   | The number of days after the purchaseorder date which a purchaseorder is due. This value is required and must be numeric.                             | 30                                           |
| Default Status Filter             | Visiting the Invoices list will list invoices of this status by default.                                                                              | All Statuses                                 |
| Default Terms                     | Default terms may be entered so they are automatically filled in on newly created purchaseorders. Changing the default terms does not affect previously created purchaseorders.                     | |
| Default Footer                    | Default footer text may be entered so it is automatically filled in on newly created purchaseorders. Changing the default footer does not affect previously created purchaseorders.                 | |
| Purchase Order Email Subject      | The customizable, default subject for outgoing purchaseorder emails.                                                                                  | Purchase Order #{{ $purchaseorder->number }} |
| Default Purchase Order Email Body | The customizable, default body for outgoing purchaseorder emails.<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}</p> | \<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}\</p>                                             |
|<span id="purchaseorder-email-while-draft" class="anchor"></span>If Purchaseorder is Emailed While in Draft Status|Depending on your workflow, you may want the date of a purchaseorder which is in draft status to automatically set itself to the current date prior to being emailed.|Keep Purchaseorder Date As Is|

### Taxes
| Setting                           | Description                                                                                                                                           | Default                                      |
|:----------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------|
|Default Item Tax Rate|If entered, this tax rate will be set as the default Tax 1 on any new items added to a quote or invoice.| |
|Default Item Tax 2 Rate|If entered, this tax rate will be set as the default Tax 2 on any new items added to a quote or invoice.| |

### Email
| Setting                           | Description                                                                                                                                           | Default                                      |
|:----------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------|
|Email Sending Method|This is the method the system will use to deliver email.| |
|SMTP Host Address|If SMTP is selected as the email sending method, enter the SMTP server address.| |
|SMTP Host Port|If SMTP is selected as the email sending method, enter the SMTP port.| |
|SMTP Username|If SMTP is selected as the email sending method, enter the SMTP account username.| |
|SMTP Password|If SMTP is selected as the email sending method, enter the SMTP account password.| |
|SMTP Encryption|If SMTP is selected as the email sending method, select the appropriate form of encryption.| |
|<span id="email-allow-self-signed-cert" class="anchor"></span>Allow Self-Signed Certificate|If you are using a self-signed certificate and receive a certificate error when sending email, set this value to Yes. Otherwise, keep it set to No.|No|
|Always Attach PDF|When set to Yes, all automatic outgoing email will attach the invoice or quote PDF.|Yes|
|Reply To Address|This will set the reply to header in outgoing email.| |
|Always CC Address|When present, the address entered will always be selected as a CC recipient of every outgoing email.| |
|Always BCC Address|When present, the address entered will always be selected as a BCC recipient of every outgoing email.| |
|Quote Email Subject|The customizable, default subject for outgoing quote emails.| |
|Default Quote Email Body|The customizable, default body for outgoing quote emails.| |
|Invoice Email Subject|The customizable, default subject for outgoing invoice emails.| |
|Default Invoice Email Body|The customizable, default body for outgoing invoice emails.| |
|Overdue Email Subject|The customizable, default subject for outgoing overdue invoice emails.| |
|Default Overdue Invoice Email Body|The customizable, default body for outgoing overdue invoice emails.| |
|Upcoming Payment Notice Email Receipt Subject|The customizable subject for outgoing payment notice emails.| |
|Upcoming Payment Notice Email Body|The customizable body for outgoing payment notice emails.| |
|Overdue Invoice Reminder Frequency|A comma separated list of days after an invoice is due to send the reminder. Leave empty to disable overdue invoice reminders. For example, a value of 1,5,10 would send reminders 1, 5 and 10 days after the invoice is due.| |
|Upcoming Payment Notice Frequency|A comma separated list of days before an invoice is due to send the reminder. Leave empty to disable upcoming payment notices. For example, a value of 1,5 would send notices 1 and 5 days before the invoice is due.| |
|Quote Approved Email Body|The customizable body for outgoing quote approved emails.| |
|Quote Rejected Email Body|The customizable body for outgoing quote rejected emails.| |
|Workorder Approved Email Body|The customizable body for outgoing workorder approved emails.| |
|Workorder Rejected Email Body|The customizable body for outgoing workorder rejected emails.| |
|Payment Receipt Email Subject|The customizable, default subject for outgoing payment receipt emails.| |
|Default Payment Receipt Body|The customizable, default body for outgoing payment receipt emails.| |

### PDF
| Setting                           | Description                                                                                                                                           | Default                                      |
|:----------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------|
|Paper Size|The PDF paper size.|Letter|
|Paper Orientation|The PDF paper orientation.|Portrait|
|Disposition|The disposition can be either inline or as an attachment|Inline|
|PDF Driver|The library used to generate PDF's.|domPDF|
|Binary Path|When wkhtmltopdf is selected as the PDF driver, the path to the wkhtmltopdf executable should be entered.| |

### Online Payments
| Setting                           | Description                                                                                                                                           | Default                                      |
|:----------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------|:---------------------------------------------|
|Mollie|These settings are used to configure the Mollie online payment integration.| |
|PayPal|These settings are used to configure the PayPal online payment integration.| |
|Stripe|These settings are used to configure the Stripe online payment integration.| |

### Scheduler
| Setting                               | Description                                                                        | Default   |
|:--------------------------------------|:-----------------------------------------------------------------------------------|:----------|
| Number of past days to load           | Number of days in the past to load into memory. Affects performance                | 60        |
| Number of events to show per day      | Number of calendar events to show in day cell before "more" is displayed. 0 = all  | 5         |
| Enable Create Workorder Functionality | Enables the Create Workorder Icon in the day cell                                  | No        |
| Full Calendar theme Systems           | The display theme for fullcalendar. can be:<br>Standard<br>Bootstrap4<br>Jquery-ui | Jquery-ui |
| Default Timepicker step in minutes    | Sets the step increment in all Timepicker Cells                                    | 30        |
| Fullcalendar aspect ration            | Sets the width to height ratio of the calendar                                     | 1.75      |
| Core events to show in calendar       | Select which core modules to show in the calendar                                  | all       |
| Display invoiced quotes and Workorders                                      | Whether to display invoiced quote and workorder core events in calendar                                                                                   | No          |


### System
| Setting                                                                                               | Description                                                                                | Default   |
|:------------------------------------------------------------------------------------------------------|:-------------------------------------------------------------------------------------------|:----------|
| Modules enabled in sidebar                                                                            | Which modules to show available in sidebar menu                                            | all       |
| Jquery-UI Theme                                                                                       | Theme applied to Jquery-UI dialogs and calendar (when scheduler theme is set to Jquery-UI) | cupertino |
| Application URl<br>Debug Enabled<br>Database Driver<br>Database Host<br>Database<br>Database Username | Informational display of some settings in BillingTrack .env file                           |           |
