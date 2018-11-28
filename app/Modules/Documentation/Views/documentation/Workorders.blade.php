@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Workorders</h2>

        <hr>



        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Workorder List</b></p>
        <p style="margin-bottom: 0; font-weight: normal; line-height: 100%">
            The workorder list shows the status of current workorders in the
            system.</p>
        <p style="margin-bottom: 0; font-weight: normal; line-height: 100%">
            The list may be sorted by the available header fields and filtered by
            selecting the appropriate tob buttons. You can also search using the
            FusionInvoiceFOSS search field in the sidebar.</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>New</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Select to crete a new workorder.</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Input the client name (a typeahead lookup is performed for existing)
            and select the creation date. If a client name is entered which does
            not exist, a new client will be created. You will then need to edit
            the new client and provide the detailed information (address, phone,
            etc.)</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>Edit (New)</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Edit (or selecting the workorder number in list) opens the selected
            workorder for editing. All common  FusionInvoiceFOSS functions apply. The
            summary field should contain a job summary (i.e. Install AC Unit),
            Job Date is the date of the job and enter estimated start and end
            times. The Will Call field may be assigned for custom will call entry
            (such as Cclient Pickup for job).</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Add Item from lookup displays all lookup items for selection into the
            workorder. These can be individually assigned or seeded by the
            Employees and Resources tables (see Utilities/Settings).</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>PDF</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Create a pdf of the current workorder</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>Copy Workorder</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Creates a new copy of the current workorder</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>Workorder to Invoice</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; font-weight: normal; line-height: 100%">
            Converts the current workorder to an invoice</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>




    </div>

@stop