@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}

    <div class="col-lg-12 mt-2">
        <div class="card card-light">
            <div class="card-body">
                {{--cut and paste doc start--}}
                <p style="margin-bottom: 0in; line-height: 100%"><font size="4" style="font-size: 16pt"><u><b>Scheduler
                                for FusionInvoiceFOSS</b></u></font></p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">This addon adds the
                    capability to FusionInvoice for creation of a FullCalendar Schedule.
                    If enabled, it integrates directly with the  Workorder addon for
                    FusionInvoice functionality. Events and recurring events can be
                    created and edited with categories and reminders.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Dashboard</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Shows a quick look
                    at the status of events.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Calendar</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">An event is a
                    calendar entry.<br/>
                    An event may be created by clicking in a day
                    cell. A reminder (or multiple reminders) can be created with the
                    event.</p>
                <p style="margin-bottom: 0in; line-height: 100%">An event can be
                    edited by clicking on the existing event.</p>
                <p style="margin-bottom: 0in; line-height: 100%">If the event was
                    created by the Workorder Addon, clicking on the event will take you
                    to the assigned workorder.</p>
                <p style="margin-bottom: 0in; line-height: 100%">If the event is a
                    recurring event , you will be warned about editing. Although it can
                    be edited individually here, if the recurrence is updated, this local
                    edit will be overwritten. Recurring events should be updated using
                    the RECURRING EVENT menu.</p>

                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Create Workorder Icon</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
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
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Create Event</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Event creation
                    outside the calendar view</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Event Table</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Shows and allows
                    editing and creating of events in a table format. You can also
                    “trash” an event here</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Recurring Event</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Edit or Create a
                    recurring event. This can be very complex. Hover over the Set
                    Recurrence labels for explanations of how they work. “Show proposed
                    recurrence” button will attempt to give you a Human readable text
                    of your selected recurrence rule. This text does not currently
                    include additions to the Position, MonthDay, Yearday or Weeknumber
                    fields.</p>
                <p style="margin-bottom: 0in; line-height: 100%">A reminder (or
                    reminders) may be assign to recurrent events.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Utilities</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <b>Table Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    A table view based report from selected start and end dates.</p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <b>Calendar Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    A calendar view based report from selected start and end dates.</p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Trash</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Contains any items “trashed” from Table Event or Recurring
                    Events.</p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Event can be restored or permanently deleted.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Categories</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Assign and edit custom calendar categories and colors. Note (3)
                    default categories and custom categories assigned to events cannot be
                    deleted.</p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Settings</b></p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent; page-break-before: auto">
                    <b>Number of past days to load</b> – Restricts calendar loading to
                    a certain number of past days. This can substantially speed up
                    Fullcalendar load performance.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Number of events to show per day</b> – How many events to show
                    in a day cell before the “+ number more” button is shown.</p>

                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Enable “Create Workorder” functionality</b> -  If “on”,
                    displays a “Create Workorder” icon in the day cell header which
                    will launch a dialog to allow population of a FusionInvoice
                    Workorder.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>FullCalendar ThemeSystem –</b> Choose between 3 theme systems
                    for FullCalendar.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Default Timepicker step in minutes </b>– Choose 60, 30, 15, 10,
                    5 or 1. Sets default step for timepicker in Create/Edit Event and
                    Create/Edit Recurring Event.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>FullCalendar </b><b>Aspect Ratio</b><b> –</b> Sets width to
                    height ratio for FullCalendar from 1 to 2 in 0.05 increments. Higher
                    value makes a “shorter” calendar. (an aspect ratio of 2 makes the
                    calendar twice as wide as it is high.)</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Core Events to show on calendar</b> – Select to enable display
                    of system core events on Scheduler calendar. Shows a selectable link
                    to the core event. “Due date/Expires at” takes precedence over
                    event date if available.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Display criteria:</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Quotes: Sent or approved, not invoiced</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Invoices: Sent, not paid</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Payments: All payments made</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Expenses: Not billed</p>

                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Projects: Active</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Tasks: Not Billed</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <br/>

                </p>
                           {{--cut and paste doc end--}}
            </div>
        </div>
    </div>
@stop