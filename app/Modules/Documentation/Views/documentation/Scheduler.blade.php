@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Scheduler</h2>

        <hr>

        <p style="margin-bottom: 0; line-height: 100%"><font size="4" style="font-size: 16pt"><u><b>Scheduler
                        for FusionInvoiceFOSS</b></u></font></p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%">This addon adds the
            capability to FusionInvoice for creation of a FullCalendar Schedule.
            If enabled, it integrates directly with the  Workorder addon for
            FusionInvoice functionality. Events and recurring events can be
            created and edited with categories and reminders.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Dashboard</b></p>
        <p style="margin-bottom: 0; line-height: 100%">Shows a quick look
            at the status of events.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Calendar</b></p>
        <p style="margin-bottom: 0; line-height: 100%">An event is a
            calendar entry.<br/>
            An event may be created by clicking in a day
            cell. A reminder (or multiple reminders) can be created with the
            event.</p>
        <p style="margin-bottom: 0; line-height: 100%">An event can be
            edited by clicking on the existing event.</p>
        <p style="margin-bottom: 0; line-height: 100%">If the event was
            created by the Workorder Addon, clicking on the event will take you
            to the assigned workorder.</p>
        <p style="margin-bottom: 0; line-height: 100%">If the event is a
            recurring event , you will be warned about editing. Although it can
            be edited individually here, if the recurrence is updated, this local
            edit will be overwritten. Recurring events should be updated using
            the RECURRING EVENT menu.</p>

        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>Create Workorder Icon</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            When enabled in settings, This will launch a dialog to populate for
            an automatic Workorder creation.  Customer will do a typeahead lookup
            of the FusionInvoice client database (same rules apply as workorder
            creation in FusionInvoice). Only Available Employees and Resources
            (un-scheduled) for the day are shown in the item selection. THIS ONLY
            TAKES INTO EFFECT SCHEDULED EMPLOYEES AND ITEMS FOR THE ENTIRE DAY.
            It does not look at time slots during the day. Resources are
            calculated against the number in inventory and the resources
            scheduled for the day. When all selections are made, select CREATE
            WORKORDER and the information will be send to FusionInvoice and
            create a draft workorder containing all the information.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Create Event</b></p>
        <p style="margin-bottom: 0; line-height: 100%">Event creation
            outside the calendar view</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Event Table</b></p>
        <p style="margin-bottom: 0; line-height: 100%">Shows and allows
            editing and creating of events in a table format. You can also
            “trash” an event here</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Recurring Event</b></p>
        <p style="margin-bottom: 0; line-height: 100%">Edit or Create a
            recurring event. This can be very complex. Hover over the Set
            Recurrence labels for explanations of how they work. “Show proposed
            recurrence” button will attempt to give you a Human readable text
            of your selected recurrence rule. This text does not currently
            include additions to the Position, MonthDay, Yearday or Weeknumber
            fields.</p>
        <p style="margin-bottom: 0; line-height: 100%">A reminder (or
            reminders) may be assign to recurrent events.</p>
        <p style="margin-bottom: 0; line-height: 100%"><br/>

        </p>
        <p style="margin-bottom: 0; line-height: 100%"><b>Utilities</b></p>

        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <b>Categories</b></p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            Assign and edit custom calendar categories and colors. Note (3)
            default categories and custom categories assigned to events cannot be
            deleted.</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <br/>
        <b>Orphan Check</b>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            List of employees who are inactive or not scheduleable and are assigned to future workorders
            .</p>
        <p style="margin-left: 0.49in; margin-bottom: 0; line-height: 100%">
            <br/>
        </p>


    </div>

@stop