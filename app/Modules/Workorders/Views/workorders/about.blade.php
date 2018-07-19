@extends('Workorders::partials._master')

@section('content')

	{!! Form::wobreadcrumbs() !!}
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i
							class="fa fa-fw fa-question-circle"></i>{{ trans('Workorders::texts.about') }}
				</h3>
			</div>
			<div class="panel-body">
	{{--cut and paste doc start--}}
				<p style="margin-bottom: 0in; line-height: 100%"><font size="4" style="font-size: 16pt"><u><b>Workorder
								Addon for FusionInvoice v2.0.2</b></u></font></p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%">This addon adds the
					capability to FusionInvoice for creation of Workorders. It integrates
					directly with the  FusionInvoice client functionality, as well as
					most other  FusionInvoice features.</p>
				<p style="margin-bottom: 0in; line-height: 100%">This addon is
					closely based on the functionality of the  FusionInvoice Quotes
					module.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Workorder List</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					The workorder list shows the status of current workorders in the
					system.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					The list may be sorted by the available header fields and filtered by
					selecting the appropriate tob buttons. You can also search using the
					FusionInvoice search field in the sidebar.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>New</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Select to crete a new workorder.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Input the client name (a typeahead lookup is performed for existing)
					and select the creation date. If a client name is entered which does
					not exist, a new client will be created. You will then need to edit
					the new client and provide the detailed information (address, phone,
					etc.)</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>Edit (New)</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Edit (or selecting the workorder number in list) opens the selected
					workorder for editing. All common  FusionInvoice functions apply. The
					summary field should contain a job summary (i.e. Install AC Unit),
					Job Date is the date of the job and enter estimated start and end
					times. The Will Call field may be assigned for custom will call entry
					(such as Cclient Pickup for job).</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Add Item from lookup displays all lookup items for selection into the
					workorder. These can be individually assigned or seeded by the
					Employees and Resources tables (see Utilities/Settings).</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>PDF</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Create a pdf of the current workorder</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>Copy Workorder</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Creates a new copy of the current workorder</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>Workorder to Invoice</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Converts the current workorder to an invoice</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><a name="__DdeLink__0_310968197"></a>
					<b>Employees</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Allows for creation of Employees that may be assigned to workorders.
					The list may be sorted by the available header fields. To edit an
					Employee, select the Employee # in the list.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>New</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Create a new employee.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<br/>

				</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Resources</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Allows for creation of Resources (inventory or standard job items)
					that may be assigned to workorders. The list may be sorted by the
					available header fields. To edit a Resource, select the Resource # in
					the list.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>New</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Create a new Resource.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Timesheet</b></p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>See Timesheet
						About</b></p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Utilities</b></p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>Batch Print</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Allows PDF creation of multiple workorders by selecting a start and
					end job date. Only workorders that are approved, not invoiced and
					meet the job date criteria are selected.</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>This function is only available with the WKHTMLTOPDF driver.</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
<span style="font-weight: normal">This driver must be installed at
your server. Contact your system administrator for help. Information
for WKHTMLTOPDF may be found at <a href="http://wkhtmltopdf.org/">http://wkhtmltopdf.org/</a>.
For Ubuntu, a package is available in the software center named
“wkhtmltopdfxo”. Default binary path on an Ubuntu installation is
“/usr/local/bin/wkhtmltopdf”.</span></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>Settings</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Configuration settings for the Workorder addon.</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
					<b>Enable Scheduler Integration</b></p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					If running the Cytech Scheduler Addon for FusionInvoice, this setting
					allows the workorder addon to create events in the Scheduler based on
					the Workorder dates and times.</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
					<b>Push Active Resources/Employees</b></p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					If set to yes, updates the item lookup table with active
					Employees/Resources.</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
					<b>Force Resource/Employee Update</b></p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Forces an itemlookup table update. This may be necessary if
					populating the Employees or Resources from an external source (i.e.
					MySQL trigger).</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__278_69494060"></a>
					<b>Enable Legacy Calendar and .ics dump ?</b></p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__280_69494060"></a>
					Legacy setting to allow connect to an external calendar thru an
					external function. Runs external function and dumps a “wocal.ics”
					file to the storage directory.</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%"><a name="__DdeLink__282_69494060"></a>
					<b>Legacy Calendar Script</b></p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__284_69494060"></a>
					Specify the script name to run if Legacy Calendar is enabled.</p>
				<p style="margin-left: 0.98in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-left: 0.5in; margin-bottom: 0in; font-variant: normal; letter-spacing: normal; font-style: normal; line-height: 100%; background: transparent; page-break-before: auto">
					<font color="#414141"><font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><b>Trash</b></font></font></font></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-variant: normal; letter-spacing: normal; font-style: normal; font-weight: normal; orphans: 2; widows: 2">
					<font color="#414141"><font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt">Contains
								any “trashed” Workorders.</font></font></font></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-variant: normal; letter-spacing: normal; font-style: normal; font-weight: normal; orphans: 2; widows: 2">
					<font color="#414141"><font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt">Trash
								(workorders) can be restored or permanently deleted.</font></font></font></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-variant: normal; letter-spacing: normal; font-style: normal; font-weight: normal; orphans: 2; widows: 2">
					<font color="#414141"><font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt">If
								Scheduler addon is present, any calendar events associated with the
								workorder will be trashed/deleted/restored also.</font></font></font></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
					<b>About</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					This Document</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Requirements</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Currently  minimum of FusionInvoice 2018-4 and its requirements.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Support</b></p>
				<p style="margin-bottom: 0in; line-height: 100%"><span style="font-variant: normal"><font color="#333333"><font face="Cabin, sans-serif"><font size="2" style="font-size: 10pt"><span style="letter-spacing: normal"><span style="font-style: normal"><span style="font-weight: normal">Technical
support is provided via email: </span></span></span></font></font></font></span><span style="font-variant: normal"><font color="#333333"><font face="Cabin, sans-serif"><font size="2" style="font-size: 10pt"><span style="letter-spacing: normal"><span style="font-style: normal"><span style="font-weight: normal">support@cytech-eng.com</span></span></span></font></font></font></span></p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Release Notes</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.0</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Initial release</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.1</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated for FusionInvoice 2016-16</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.2</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated for FusionInvoice 2016-17</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__317_519684288"></a>
					Cytech Workorder Addon for FusionInvoice version 1.0.3</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Corrected Workorder delete listener and workorder validation</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__569_519684288"></a>
					Corrected workorder resource controller for null fail</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Changed order of event description on save</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Changed employees edit/create blade files to correct wrong datalist
					structure</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__572_519684288"></a>
					Cytech Workorder Addon for FusionInvoice version 1.0.4</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2016-18 and 2016-19</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Corrected typeahead lookup in workorder Add Item</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Corrected saving of tax_id in “Save Item as Lookup</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__567_519684288"></a>
					Added additional translations</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.5</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2016-20</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.6</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-2</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.7</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-4</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.8</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-5</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.9</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-7</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.10</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-8</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.11</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-9</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.12</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-10</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.13</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-11. Addition of Status Filters.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.14</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__457_2722625909"></a>
					Added Timesheet generation to Workorders. Includes export to
					Quickbooks Timer.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 1.0.15</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2017-13</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 2.0.0</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Initial update for compatibility with Scheduler v2.0.0</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 2.0.1</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2018-4</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Cytech Workorder Addon for FusionInvoice version 2.0.2</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Updated to FusionInvoice 2018-7</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Installation</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Extract zip file directly into FusionInvoice web directory</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Then in FusionInvoice select SYSTEM ADDONS and install.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><a name="__DdeLink__290_1195472889"></a>
					<span style="font-weight: normal">In </span>FusionInvoiceI System
					Settings:</p>
				<p style="margin-bottom: 0in; line-height: 100%">    Dashboard tab -
					enable workorder summary widget, display order = 1, column width = 6</p>
				<p style="margin-bottom: 0in; line-height: 100%">    set invoice
					display order = 2, quote display order = 3</p>
				<p style="margin-bottom: 0in; line-height: 100%">If using Workorders
					batch print function:</p>
				<p style="margin-bottom: 0in; line-height: 100%">     PDF – set pdf
					driver to wkhtmltopdf   - Binary path - /usr/local/bin/wkhtmltopdf</p>
				<p style="margin-bottom: 0in; line-height: 100%">This driver must be
					installed at your server. Contact your system administrator for help.
					Information for WKHTMLTOPDF may be found at http://wkhtmltopdf.org/.
					For Ubuntu, a package is available in the software center named
					“wkhtmltopdfxo”. Default binary path on an Ubuntu installation is
					“/usr/local/bin/wkhtmltopdf”.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Upgrade</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Extract zip file directly into FusionInvoice web directory</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Then in FusionInvoice select SYSTEM ADDONS and update.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>FAQ</b></p>
				<p style="margin-bottom: 0in; line-height: 100%">None at this time.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>License</b></p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Cytech Workorder
						Addon for FusionInvoice License Agreement</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					This license is a legal agreement between you and Cytech for the use
					of Cytech Workorder Addon for FusionInvoice  (the &quot;Software&quot;).
					By downloading any version of Cytech Workorder Addon for
					FusionInvoice  you agree to be bound by the terms and conditions of
					this license. Cytech reserves the right to alter or terminate this
					agreement at any time, for any reason, with or without notice.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Permitted Use</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					This license permits a single installation in a production
					environment and a single ancillary &quot;development use only&quot;
					installation to support the live installation (such as testing
					environments). Additional installations require additional license
					purchases.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>License
						Restrictions</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Unless you have been granted prior, written consent from Cytech, you
					may not:</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					<br/>

				</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Use the Software as the basis of a hosted service, or to provide
					hosted services to others.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Reproduce, distribute, or transfer the Software, or portions thereof,
					to any third party.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Sell, rent, lease, assign, or sublet the Software or portions
					thereof.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Grant rights to any other person.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Use the Software in violation of any U.S. or international law or
					regulation.</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Display of Copyright Notices</p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					All copyright and proprietary notices within the Software files must
					remain intact.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Making Copies</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					You may make copies of the Software for back-up purposes, provided
					that you reproduce the Software in its original form and with all
					proprietary notices on the back-up copy.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Software
						Modification</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					You may alter, modify, or extend the Software for your own use, or
					commission a third-party to perform modifications for you, but you
					may not resell, redistribute or transfer the modified or derivative
					version without prior written consent from Cytech. Components from
					the Software may not be extracted and used in other programs without
					prior written consent from Cytech.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Refund Policy</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Due to the non-returnable nature of downloadable software, Cytech
					does not issue refunds once a transaction has been completed. If you
					have questions about whether or not Cytech Workorder Addon for
					FusionInvoice  will work for you, please contact us with any
					questions.
				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Indemnity</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					You agree to indemnify and hold harmless Cytech for any third-party
					claims, actions or suits, as well as any related expenses,
					liabilities, damages, settlements or fees arising from your use or
					misuse of the Software, or a violation of any terms of this license.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Disclaimer Of
						Warranty</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND,
					EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF
					QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS
					FOR A PARTICULAR PURPOSE. FURTHER, Cytech DOES NOT WARRANT THAT THE
					SOFTWARE OR ANY RELATED SERVICE WILL ALWAYS BE AVAILABLE.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><b>Limitations Of
						Liability</b></p>
				<p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
					YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE
					SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE
					SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING
					FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE
					SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND
					ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED
					TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR
					SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				<p style="margin-bottom: 0in; line-height: 100%"><br/>

				</p>
				{{--cut and paste doc end--}}
			</div>
		</div>
	</div>
@stop