@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Scheduler</h2>

        <hr>


        <p>Creation of a FullCalendar Schedule.
            Events and recurring events can be
            created and edited with categories and reminders.
            Core Events (Quotes, Workorders, Invoices, etc.) can be shown via the system settings - Scheduler tab</p>
        <p>

        </p>
        <p><b>Dashboard</b></p>
        <p>Shows a quick look
            at the status of events.</p>
        <p>

        </p>
        <p><b>Calendar</b></p>
        <p>An event is a
            calendar entry.
            An event may be created by clicking in a day
            cell. A reminder (or multiple reminders) can be created with the
            event.</p>
        <p>An event can be
            edited by clicking on the existing event.</p>
        <p>If the event was
            created by a core event (quote, workorder, invoice, etc.), clicking on the event will take you
            to the assigned document.</p>
        <p>If the event is a
            recurring event , you will be taken to the edit page of the selected recurring event.</p>

        <p>
            <b>Create Workorder Icon</b></p>
        <p>
            When enabled in settings, This will launch a dialog to populate for
            an automatic Workorder creation.  Customer will do a typeahead lookup
            of the BillingTrack client database (same rules apply as workorder
            creation in BillingTrack). Only Available Employees and Resources
            (un-scheduled) for the day are shown in the item selection. THIS ONLY
            TAKES INTO EFFECT SCHEDULED EMPLOYEES AND ITEMS FOR THE ENTIRE DAY.
            It does not look at time slots during the day. Resources are
            calculated against the number in inventory and the resources
            scheduled for the day. When all selections are made, select CREATE
            WORKORDER and the information will be send to BillingTrack and
            create an approved workorder containing all the information.
            Note: If a NEW client name is entered, you will be taken to the workorder
            after create to edit the client information.</p>
        <p>

        </p>
        <p><b>Create Event</b></p>
        <p>Event creation
            outside the calendar view</p>
        <p>

        </p>
        <p><b>Event Table</b></p>
        <p>Shows and allows
            editing and creating of events in a table format. You can also
            “trash” an event here</p>
        <p>

        </p>
        <p><b>Recurring Event</b></p>
        <p>Edit or Create a
            recurring event. This can be very complex. Hover over the Set
            Recurrence labels for explanations of how they work. “Show proposed
            recurrence” button will attempt to give you a Human readable text
            of your selected recurrence rule. This text does not currently
            include additions to the Position, MonthDay, Yearday or Weeknumber
            fields.</p>
        <p>A reminder (or
            reminders) may be assign to recurrent events.</p>
        <p>

        </p>
        <p><b>Utilities</b></p>
<ul>
        <p>
            <b>Categories</b></p>
        <p>
            Assign and edit custom calendar categories and colors. Note (10)
            default categories and custom categories assigned to events cannot be
            deleted.</p>
        <p>

        <b>Orphan Check</b>
        <p>
            List of employees who are inactive or not scheduleable and are assigned to future workorders
            .</p>
        <p>

        </p>
</ul>

    </div>

@stop
