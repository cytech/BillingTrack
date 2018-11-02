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
				<p style="margin-bottom: 0in; line-height: 100%"><font size="4" style="font-size: 16pt"><u><b>Workorders
								for FusionInvoiceFOSS</b></u></font></p>
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
					<b>Settings</b></p>
				<p style="margin-left: 0.49in; margin-bottom: 0in; font-weight: normal; line-height: 100%">
					Configuration settings for the Workorder addon.</p>
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
			{{--cut and paste doc end--}}
			</div>
		</div>
	</div>
@stop